<h2 class="text-2xl text-center font-bold mb-4">Chansons disponibles</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($songs as $song): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold"><?php echo htmlspecialchars($song['title']); ?></h3>
            <p><?php echo htmlspecialchars($song['artist']); ?></p>
            <audio controls src="<?php echo htmlspecialchars($song['file_path']); ?>" class="mt-2 w-full"></audio>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="mt-2 flex justify-between items-center">
                    <form action="index.php?action=toggle_like" method="post">
                        <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
                        <button type="submit" class="text-red-500">
                            <?php echo $song['is_liked'] ? '❤️' : '🤍'; ?>
                        </button>
                    </form>
                    
                    <?php if (count($playlists) > 0): // Vérifie si l'utilisateur a des playlists ?>
                        <form action="index.php?action=add_song_to_playlist" method="post">
                            <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
                            <select name="playlist_id" required class="mr-2">
                                <?php foreach ($playlists as $playlist): ?>
                                    <option value="<?php echo $playlist['id']; ?>"><?php echo htmlspecialchars($playlist['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Ajouter à la playlist</button>
                        </form>
                    <?php else: ?>
                        <p class="text-gray-500">Aucune playlist disponible</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
