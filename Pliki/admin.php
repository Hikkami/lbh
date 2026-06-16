<?php
session_start();

$metaRobots = "noindex, nofollow"; 
$correct_password = 'Wirepassword';
$postsFile = 'posts.json';
$galleryDir = 'gallery';

// Tworzenie katalogu na zdjęcia, jeśli nie istnieje
if (!file_exists($galleryDir)) {
    mkdir($galleryDir, 0755, true);
}

if (!file_exists($postsFile)) {
    $initialData = [
        [
            "id" => time(),
            "title" => "Witamy na nowej stronie WAI Poland Chapter!",
            "content" => "<p>Rozpoczynamy nowy etap działalności w kierunku rozszerzenia naszej działalności na Europę Środkową. Zapraszamy do zapoznania się z nami i śledzenia aktualności.</p>",
            "date" => date('d.m.Y')
        ]
    ];
    file_put_contents($postsFile, json_encode($initialData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

$error = '';
$success = '';

if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $password = $_POST['password'] ?? '';
    if (hash_equals($correct_password, $password)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = 'Nieprawidłowe hasło dostępu.';
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['admin_logged_in']);
    session_destroy();
    header("Location: admin.php");
    exit;
}

$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

if ($isLoggedIn) {
    // 1. Obsługa dodawania wpisu z edytora tekstu
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($title !== '' && $content !== '') {
            $posts = [];
            if (file_exists($postsFile)) {
                $posts = json_decode(file_get_contents($postsFile), true) ?? [];
            }

            $newPost = [
                "id" => time(),
                "title" => $title,
                "content" => $content,
                "date" => date('d.m.Y')
            ];

            array_unshift($posts, $newPost);
            file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
            
            $_SESSION['flash_success'] = 'Pomyślnie opublikowano nowy wpis!';
            header("Location: admin.php");
            exit;
        } else {
            $error = 'Wszystkie pola formularza muszą zostać wypełnione.';
        }
    }

    // 2. Obsługa usuwania wpisu
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $idToDelete = (int)($_GET['id'] ?? 0);
        if ($idToDelete > 0) {
            $posts = [];
            if (file_exists($postsFile)) {
                $posts = json_decode(file_get_contents($postsFile), true) ?? [];
            }

            $filteredPosts = array_filter($posts, function($p) use ($idToDelete) {
                return (int)$p['id'] !== $idToDelete;
            });

            file_put_contents($postsFile, json_encode(array_values($filteredPosts), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
            
            $_SESSION['flash_success'] = 'Wpis został pomyślnie usunięty.';
            header("Location: admin.php");
            exit;
        }
    }

    // 3. Obsługa wgrywania zdjęcia do galerii
    if (isset($_POST['action']) && $_POST['action'] === 'upload_image') {
        if (isset($_FILES['gallery_file']) && $_FILES['gallery_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['gallery_file']['tmp_name'];
            $fileName = $_FILES['gallery_file']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Czyszczenie nazwy pliku i dodanie unikalnego prefiksu
                $cleanFileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
                $newFileName = time() . '_' . $cleanFileName;
                $dest_path = $galleryDir . '/' . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $_SESSION['flash_success'] = 'Zdjęcie zostało pomyślnie dodane do galerii!';
                } else {
                    $error = 'Wystąpił nieoczekiwany błąd podczas zapisu pliku.';
                }
            } else {
                $error = 'Format pliku nie jest obsługiwany. Dozwolone formaty: JPG, JPEG, PNG, GIF, WEBP.';
            }
        } else {
            $error = 'Wystąpił błąd podczas przesyłania pliku. Sprawdź limit rozmiaru plików na swoim serwerze.';
        }
        header("Location: admin.php");
        exit;
    }

    // 4. Obsługa usuwania zdjęcia z galerii
    if (isset($_GET['action']) && $_GET['action'] === 'delete_image') {
        $imageFile = basename($_GET['file'] ?? '');
        $targetFile = $galleryDir . '/' . $imageFile;
        if ($imageFile !== '' && file_exists($targetFile)) {
            unlink($targetFile);
            $_SESSION['flash_success'] = 'Zdjęcie zostało usunięte z galerii.';
        } else {
            $error = 'Nie odnaleziono pliku do usunięcia.';
        }
        header("Location: admin.php");
        exit;
    }
}

if (isset($_SESSION['flash_success'])) {
    $success = $_SESSION['flash_success'];
    unset($_SESSION['flash_success']);
}

$pageTitle = "Panel Administratora - WAI Poland Chapter";
include 'header.php';
?>

<!-- Import biblioteki edytora tekstu Quill -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<div class="max-w-4xl mx-auto mt-6">
    <?php if (!$isLoggedIn): ?>
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Panel Administratora</h2>
            
            <?php if ($error): ?>
                <div class="bg-red-50 text-red-700 p-3 rounded mb-4 border border-red-200 text-sm">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="admin.php" class="space-y-4">
                <input type="hidden" name="action" value="login">
                <div>
                    <label for="password" class="block text-gray-700 mb-2 font-medium">Hasło dostępu</label>
                    <input type="password" id="password" name="password" required class="w-full p-2.5 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Wprowadź hasło">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded hover:bg-blue-700 transition font-bold">Zaloguj się</button>
            </form>
        </div>
    <?php else: ?>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Panel Zarządzania Treścią</h2>
            <a href="admin.php?action=logout" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded font-semibold text-sm transition inline-flex items-center"><i class="fas fa-sign-out-alt mr-2"></i>Wyloguj się</a>
        </div>

        <?php if ($success): ?>
            <div class="bg-green-50 text-green-700 p-4 rounded mb-6 border border-green-200 text-sm">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="bg-red-50 text-red-700 p-4 rounded mb-6 border border-red-200 text-sm">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- SEKCJA DODAWANIA WPISU Z EDYTOREM WYSIWYG -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 mb-8">
            <h3 class="text-xl font-bold text-blue-800 mb-6">Dodaj nowy wpis</h3>
            <form method="POST" action="admin.php" id="post-form" class="space-y-4">
                <input type="hidden" name="action" value="add">
                <div>
                    <label for="title" class="block text-gray-700 mb-2 font-semibold">Tytuł wpisu</label>
                    <input type="text" id="title" name="title" required class="w-full p-2.5 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Wpisz tytuł...">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2 font-semibold">Treść wpisu</label>
                    <!-- Kontener Quill -->
                    <div id="editor-container" class="bg-white h-64 border rounded-b"></div>
                    <input type="hidden" id="hidden-content" name="content">
                </div>
                <button type="submit" class="bg-green-600 text-white px-6 py-2.5 rounded hover:bg-green-700 transition font-bold shadow"><i class="fas fa-check mr-2"></i>Opublikuj wpis</button>
            </form>
        </div>

        <!-- SEKCJA WGrywania ZDJĘĆ DO GALERII -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 mb-8">
            <h3 class="text-xl font-bold text-blue-800 mb-6">Wgraj zdjęcie do galerii</h3>
            <form method="POST" action="admin.php" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="action" value="upload_image">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                    <input type="file" name="gallery_file" id="gallery_file" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="space-y-2">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                        <p class="text-sm font-semibold text-gray-600">Kliknij lub przeciągnij plik tutaj, aby dodać</p>
                        <p class="text-xs text-gray-400">Dopuszczalne formaty: JPG, JPEG, PNG, GIF, WEBP</p>
                    </div>
                </div>
                <div id="file-name-preview" class="text-sm text-gray-600 font-medium hidden">Wybrany plik: <span id="file-name-span"></span></div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded hover:bg-blue-700 transition font-bold shadow"><i class="fas fa-upload mr-2"></i>Wyślij na serwer</button>
            </form>
        </div>

        <!-- LISTA WPISÓW -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Zarządzaj wpisami</h3>
            <?php
            $posts = [];
            if (file_exists($postsFile)) {
                $posts = json_decode(file_get_contents($postsFile), true) ?? [];
            }
            if (empty($posts)):
            ?>
                <p class="text-gray-500">Brak postów do wyświetlenia.</p>
            <?php else: ?>
                <ul class="space-y-4">
                    <?php foreach ($posts as $post): ?>
                        <li class="flex justify-between items-center p-4 border rounded bg-gray-50 hover:bg-gray-100 transition">
                            <div class="pr-4">
                                <p class="font-bold text-gray-800"><?php echo htmlspecialchars($post['title']); ?></p>
                                <p class="text-sm text-gray-500"><i class="far fa-clock mr-1"></i><?php echo htmlspecialchars($post['date']); ?></p>
                            </div>
                            <a href="admin.php?action=delete&id=<?php echo $post['id']; ?>" onclick="return confirm('Czy na pewno chcesz trwale usunąć ten wpis?');" class="text-red-500 hover:text-white hover:bg-red-600 border border-red-500 px-3 py-1.5 rounded transition text-sm font-semibold whitespace-nowrap"><i class="fas fa-trash mr-1"></i> Usuń</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- ZARZĄDZANIE ZDJĘCIAMI W GALERII -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Zarządzaj zdjęciami w galerii</h3>
            <?php
            $images = [];
            if (file_exists($galleryDir)) {
                $images = glob($galleryDir . '/*.{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}', GLOB_BRACE);
            }
            if (empty($images)):
            ?>
                <p class="text-gray-500">Brak zdjęć w galerii.</p>
            <?php else: ?>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <?php foreach ($images as $img): 
                        $imgName = basename($img);
                    ?>
                        <div class="relative group rounded border overflow-hidden shadow-sm bg-gray-50 aspect-square flex flex-col justify-between">
                            <img src="<?php echo htmlspecialchars($img); ?>" alt="Miniatura" class="w-full h-2/3 object-cover">
                            <div class="p-2 h-1/3 flex items-center justify-between bg-white">
                                <span class="text-xs truncate text-gray-500 pr-1" title="<?php echo htmlspecialchars(substr($imgName, 11)); ?>">
                                    <?php echo htmlspecialchars(substr($imgName, 11)); ?>
                                </span>
                                <a 
                                    href="admin.php?action=delete_image&file=<?php echo urlencode($imgName); ?>" 
                                    onclick="return confirm('Usunąć to zdjęcie z galerii?');" 
                                    class="text-red-500 hover:text-red-700 transition"
                                    title="Usuń zdjęcie"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>
// Konfiguracja edytora tekstu Quill
document.addEventListener('DOMContentLoaded', () => {
    const editorContainer = document.getElementById('editor-container');
    if (editorContainer) {
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'clean']
                ]
            }
        });

        const form = document.getElementById('post-form');
        form.addEventListener('submit', (e) => {
            const hiddenContent = document.getElementById('hidden-content');
            hiddenContent.value = quill.root.innerHTML;
            
            // Weryfikacja czy post nie jest pusty
            if (quill.getText().trim() === '') {
                alert('Treść wpisu nie może być pusta!');
                e.preventDefault();
            }
        });
    }

    // Podgląd nazwy wybranego pliku graficznego
    const fileInput = document.getElementById('gallery_file');
    const namePreview = document.getElementById('file-name-preview');
    const nameSpan = document.getElementById('file-name-span');
    if (fileInput && namePreview && nameSpan) {
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                nameSpan.textContent = fileInput.files[0].name;
                namePreview.classList.remove('hidden');
            } else {
                namePreview.classList.add('hidden');
            }
        });
    }
});
</script>

<?php include 'footer.php'; ?>