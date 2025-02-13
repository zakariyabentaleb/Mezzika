<h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Modifier la playlist</h2>
<form action="index.php?action=edit_playlist&id=<?php echo $playlist['id']; ?>" method="post" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="mb-6">
        <label for="name" class="block text-gray-700 mb-2 text-sm font-medium">Nom de la playlist</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($playlist['name']); ?>" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>

    <div class="mb-6">
        <label for="is_public" class="inline-flex items-center text-sm font-medium text-gray-700">
            <input type="hidden" name="is_public" value="0">
            <input type="checkbox" id="is_public" name="is_public" value="1" <?php echo $playlist['is_public'] ? 'checked' : ''; ?> class="form-checkbox text-green-500 focus:ring-green-500 transition duration-300 ease-in-out">
            <span class="ml-2">Rendre la playlist publique</span>
        </label>
    </div>

    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg w-full shadow-md hover:bg-green-700 hover:shadow-xl transition duration-300 ease-in-out">Enregistrer les modifications</button>
</form>
