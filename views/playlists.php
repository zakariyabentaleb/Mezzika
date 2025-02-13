<h2 class="text-2xl font-bold mb-4">Mes playlists</h2>
<a href="index.php?action=create_playlist" class="bg-green-500 text-white px-4 py-2 rounded inline-block mb-4">Créer une nouvelle playlist</a>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($user_playlists as $playlist): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold"><?php echo htmlspecialchars($playlist['name']); ?></h3>
            <p><?php echo $playlist['is_public'] ? 'Publique' : 'Privée'; ?></p>
            <div class="mt-2 flex justify-between">
                <a href="index.php?action=view_playlist&id=<?php echo $playlist['id']; ?>" class="text-blue-500">Voir les chansons</a>
                <a href="index.php?action=edit_playlist&id=<?php echo $playlist['id']; ?>" class="text-yellow-500">Modifier</a>
            </div>
            <form action="index.php?action=delete_playlist" method="post" class="mt-2" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette playlist ?');">
                <input type="hidden" name="playlist_id" value="<?php echo $playlist['id']; ?>">
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded w-full">Supprimer la playlist</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<h2 class="text-2xl font-bold mb-4 mt-8">Playlists suivies</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($followed_playlists as $playlist): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold"><?php echo htmlspecialchars($playlist['name']); ?></h3>
            <p>Créée par : <?php echo htmlspecialchars($playlist['username']); ?></p>
            <a href="index.php?action=view_playlist&id=<?php echo $playlist['id']; ?>" class="text-blue-500">Voir les chansons</a>
            <form action="index.php?action=toggle_follow_playlist" method="post" class="mt-2">
                <input type="hidden" name="playlist_id" value="<?php echo $playlist['id']; ?>">
                <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded w-full">Ne plus suivre</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

