<h2 class="text-2xl text-center font-bold mb-4">Playlists publiques</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($public_playlists as $playlist): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold"><?php echo htmlspecialchars($playlist['name']); ?></h3>
            <p>Créée par : <?php echo htmlspecialchars($playlist['username']); ?></p>
            <a href="index.php?action=view_playlist&id=<?php echo $playlist['id']; ?>" class="text-blue-500">Voir les chansons</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="index.php?action=toggle_follow_playlist" method="post" class="mt-2">
                    <input type="hidden" name="playlist_id" value="<?php echo $playlist['id']; ?>">
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded w-full">
                        <?php echo $playlist['is_following'] ? 'Ne plus suivre' : 'Suivre'; ?>
                    </button>
                </form>
            <?php else: ?>
                <p class="mt-2 text-sm text-gray-500">Connectez-vous pour suivre cette playlist</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

