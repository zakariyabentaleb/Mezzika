<h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Connexion</h2>
<form action="index.php?action=login" method="post" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="mb-6">
        <label for="email" class="block text-gray-700 mb-2 text-sm font-medium">Email</label>
        <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>
    <div class="mb-6">
        <label for="password" class="block text-gray-700 mb-2 text-sm font-medium">Mot de passe</label>
        <input type="password" id="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
    </div>
    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg w-full shadow-md hover:bg-green-700 hover:shadow-xl transition duration-300 ease-in-out">Se connecter</button>
</form>
