<?php
header('Content-Type: application/json');

$PASSWORD = 'Wirepassword';
$FILE = 'posts.json';

if (!file_exists($FILE)) {
    $initialData = [
        [
            "id" => time(),
            "title" => "Witamy na nowej stronie WAI Poland Chapter!",
            "content" => "Rozpoczynamy nowy etap działalności w kierunku rozszerzenia naszej działalności na Europę Środkową. Zapraszamy do zapoznania się z naszą ofertą współpracy i śledzenia aktualności.",
            "date" => date('d.m.Y')
        ]
    ];
    file_put_contents($FILE, json_encode($initialData, JSON_PRETTY_PRINT));
}

$action = isset($_GET['action']) ? $_GET['action'] : 'get';

function checkAuth() {
    global $PASSWORD;
    $token = isset($_GET['token']) ? $_GET['token'] : '';
    
    if (!$token) {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
        } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $token = str_replace('Bearer ', '', $_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
        }
    }
    
    if ($token !== $PASSWORD) {
        http_response_code(401);
        echo json_encode(["success" => false, "message" => "Brak autoryzacji"]);
        exit;
    }
}

if ($action === 'get') {
    echo file_get_contents($FILE);
    exit;
}

if ($action === 'login') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['password']) && $input['password'] === $PASSWORD) {
        echo json_encode(["success" => true, "token" => $PASSWORD]); 
    } else {
        http_response_code(401);
        echo json_encode(["success" => false]);
    }
    exit;
}

if ($action === 'add') {
    checkAuth();
    $input = json_decode(file_get_contents('php://input'), true);
    
    $posts = json_decode(file_get_contents($FILE), true);
    $newPost = [
        "id" => time(),
        "title" => $input['title'],
        "content" => $input['content'],
        "date" => date('d.m.Y')
    ];
    
    array_unshift($posts, $newPost);
    file_put_contents($FILE, json_encode($posts, JSON_PRETTY_PRINT));
    
    echo json_encode($newPost);
    exit;
}

if ($action === 'delete') {
    checkAuth();
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    $posts = json_decode(file_get_contents($FILE), true);
    $posts = array_filter($posts, function($p) use ($id) {
        return $p['id'] !== $id;
    });
    
    file_put_contents($FILE, json_encode(array_values($posts), JSON_PRETTY_PRINT));
    echo json_encode(["success" => true]);
    exit;
}
?>