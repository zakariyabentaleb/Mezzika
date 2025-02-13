<h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Modifier la chanson</h2>
<form action="index.php?action=edit_song" method="post" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">

    <div class="mb-6">
        <label for="title" class="block text-gray-700 mb-2 text-sm font-medium">Titre</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($song['title']); ?>" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>

    <div class="mb-6">
        <label for="artist" class="block text-gray-700 mb-2 text-sm font-medium">Artiste</label>
        <input type="text" id="artist" name="artist" value="<?php echo htmlspecialchars($song['artist']); ?>" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>

    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg w-full shadow-md hover:bg-green-700 hover:shadow-xl transition duration-300 ease-in-out">Enregistrer les modifications</button>
</form>
