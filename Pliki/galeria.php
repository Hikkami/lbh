<?php
$pageTitle = "Galeria Zdjęć - WAI Poland Chapter";
$metaDescription = "Zobacz galerię zdjęć z wydarzeń, konferencji oraz sympozjów organizowanych przez Międzynarodowe Stowarzyszenie Ciągarskie w Polsce.";
include 'header.php';

$galleryDir = 'gallery';
$images = [];

// Skanowanie katalogu w poszukiwaniu zdjęć
if (file_exists($galleryDir)) {
    $images = glob($galleryDir . '/*.{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}', GLOB_BRACE);
}
?>

<div class="space-y-6">
    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
        <h2 class="text-3xl font-bold text-blue-800 mb-6">Galeria zdjęć</h2>
        
        <?php if (empty($images)): ?>
            <p class="text-gray-500 text-center py-12">Brak zdjęć w galerii.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($images as $img): 
                    $imgName = basename($img);
                ?>
                    <div class="group relative overflow-hidden rounded-lg shadow border border-gray-100 bg-gray-50 aspect-video sm:aspect-square">
                        <img 
                            src="<?php echo htmlspecialchars($img); ?>" 
                            alt="WAI Galeria" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out"
                        >
                        <!-- Odnośnik lightbox -->
                        <a 
                            href="<?php echo htmlspecialchars($img); ?>" 
                            data-title="<?php echo htmlspecialchars(substr($imgName, 11)); ?>" 
                            class="gallery-item absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white text-lg font-medium"
                        >
                            <span class="bg-blue-800 bg-opacity-85 p-3 rounded-full hover:bg-blue-700 transition">
                                <i class="fas fa-search-plus"></i>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Lightbox Modal Container -->
<div id="lightbox-modal" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <button id="lightbox-close" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 focus:outline-none" aria-label="Zamknij galerię">&times;</button>
    <div class="max-w-4xl max-h-[85vh] p-4 flex flex-col items-center">
        <img id="lightbox-image" src="" alt="Powiększone zdjęcie" class="max-w-full max-h-[80vh] object-contain rounded shadow-2xl">
        <p id="lightbox-caption" class="text-gray-300 mt-4 text-sm text-center font-medium"></p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const modal = document.getElementById('lightbox-modal');
    const modalImg = document.getElementById('lightbox-image');
    const modalCaption = document.getElementById('lightbox-caption');
    const closeBtn = document.getElementById('lightbox-close');

    galleryItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const src = item.getAttribute('href');
            const title = item.dataset.title;
            
            modalImg.src = src;
            modalCaption.textContent = title;
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
            }, 50);
        });
    });

    const closeModal = () => {
        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    };

    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal || e.target === closeBtn) {
            closeModal();
        }
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>

<?php include 'footer.php'; ?>