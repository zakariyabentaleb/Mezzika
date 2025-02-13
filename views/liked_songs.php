<h2 class="text-2xl text-center font-bold mb-4">Mes chansons aimées</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($liked_songs as $song): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold"><?php echo htmlspecialchars($song['title']); ?></h3>
            <p><?php echo htmlspecialchars($song['artist']); ?></p>
            <audio controls src="<?php echo htmlspecialchars($song['file_path']); ?>" class="mt-2 w-full"></audio>
            <form action="index.php?action=toggle_like" method="post" class="mt-2">
                <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Ne plus aimer</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

