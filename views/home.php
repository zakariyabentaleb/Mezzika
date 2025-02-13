<div class="text-center">
    <h1 class="text-4xl font-bold mb-4">Bienvenue sur Spotify Clone</h1>
    <p class="text-xl mb-8">Découvrez, écoutez et partagez votre musique préférée</p>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="space-x-4">
            <a href="index.php?action=register" class="bg-green-500 text-white px-6 py-3 rounded-full text-lg font-semibold">S'inscrire</a>
            <a href="index.php?action=login" class="bg-white text-green-500 px-6 py-3 rounded-full text-lg font-semibold border border-green-500">Se connecter</a>
            
        </div>
    <?php endif; ?>
</div>

