<?php
$pageTitle = "WAI Poland Chapter - Międzynarodowe Stowarzyszenie Ciągarskie w Polsce";
$metaDescription = "Śledź aktualności, zapowiedzi i wydarzenia Międzynarodowego Stowarzyszenia Ciągarskiego w Polsce. Bądź na bieżąco z polską branżą metalową.";
include 'header.php';

$postsFile = 'posts.json';
$posts = [];
if (file_exists($postsFile)) {
    $posts = json_decode(file_get_contents($postsFile), true) ?? [];
}
?>

<div class="space-y-6">
    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">Aktualności</h2>
        <?php if (empty($posts)): ?>
            <p class="text-gray-500 text-center py-8">Brak wiadomości do wyświetlenia.</p>
        <?php else: ?>
            <div class="space-y-8">
                <?php foreach ($posts as $post): ?>
                    <article class="border-b border-gray-200 pb-6 last:border-0">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($post['title']); ?></h3>
                        <span class="text-sm text-gray-500 block mb-4">
                            <i class="far fa-calendar-alt mr-2"></i><?php echo htmlspecialchars($post['date']); ?>
                        </span>
                        <!-- dynamiczny kontener interpretujący sformatowaną treść -->
                        <div class="text-gray-700 rich-text">
                            <?php echo $post['content']; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>