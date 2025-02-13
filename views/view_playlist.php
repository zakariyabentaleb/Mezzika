<?php 
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; 
?>
<h2 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($playlist['name']); ?></h2>
<p class="mb-4"><?php echo $playlist['is_public'] ? 'Playlist publique' : 'Playlist privée'; ?></p>

<?php if ($playlist['user_id'] !== $user_id): ?>
    <form action="index.php?action=toggle_follow_playlist" method="post" class="mb-4">
        <input type="hidden" name="playlist_id" value="<?php echo $playlist['id']; ?>">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
            <?php echo $is_following ? 'Ne plus suivre' : 'Suivre'; ?>
        </button>
    </form>
<?php endif; ?>

<div class="grid gap-4">
    <?php foreach ($songs as $song): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold"><?php echo htmlspecialchars($song['title']); ?></h3>
            <p><?php echo htmlspecialchars($song['artist']); ?></p>

            <audio controls src="<?php echo htmlspecialchars($song['file_path']); ?>" class="mt-2 w-full"></audio>
            <?php if ($playlist['user_id'] === $user_id): ?>
                <form action="index.php?action=remove_song_from_playlist" method="post" class="mt-2">
                    <input type="hidden" name="playlist_id" value="<?php echo $playlist['id']; ?>">
                    <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Retirer de la playlist</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
