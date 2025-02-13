<h2 class="text-2xl font-bold mb-4">Mes chansons</h2>
<a href="index.php?action=upload" class="bg-green-500 text-white px-4 py-2 rounded inline-block mb-4">Téléverser une nouvelle chanson</a>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($songs as $song): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold"><?php echo htmlspecialchars($song['title']); ?></h3>
            <p><?php echo htmlspecialchars($song['artist']); ?></p>
            <audio controls src="<?php echo htmlspecialchars($song['file_path']); ?>" class="mt-2 w-full"></audio>
            <div class="mt-2 flex justify-between">
                <a href="index.php?action=edit_song&id=<?php echo $song['id']; ?>" class="bg-blue-500 text-white px-2 py-1 rounded">Modifier</a>
                <form action="index.php?action=delete_song" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette chanson ?');">
                    <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

