<h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Téléverser une chanson</h2>
<form action="index.php?action=upload" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="mb-6">
        <label for="title" class="block text-gray-700 mb-2 text-sm font-medium">Titre</label>
        <input type="text" id="title" name="title" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>

    <div class="mb-6">
        <label for="artist" class="block text-gray-700 mb-2 text-sm font-medium">Artiste</label>
        <input type="text" id="artist" name="artist" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>

    <div class="mb-6">
        <label for="song" class="block text-gray-700 mb-2 text-sm font-medium">Fichier audio</label>
        <input type="file" id="song" name="song" accept="audio/*" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>

    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg w-full shadow-md hover:bg-green-700 hover:shadow-xl transition duration-300 ease-in-out">Téléverser</button>
</form>
