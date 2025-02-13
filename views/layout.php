<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-blue-900 p-4 shadow-lg rounded-b-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-white text-3xl font-extrabold tracking-wide">🎵 Spotify Clone</a>
            <ul class="flex space-x-6">
                
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?action=public_playlists" class="text-white hover:text-emerald-300 transition">Playlists</a></li>
                    <li><a href="index.php?action=songs" class="text-white hover:text-emerald-300 transition">Chansons</a></li>
                    <li><a href="index.php?action=login" class="bg-emerald-500 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-600 transition">Connexion</a></li>
                    <li><a href="index.php?action=register" class="bg-white text-blue-900 px-4 py-2 rounded-lg shadow hover:bg-gray-200 transition">Inscription</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'user' || $_SESSION['role'] === 'artist')): ?>
                    <li><a href="index.php?action=songs" class="text-white hover:text-emerald-300 transition">Chansons</a></li>
                    <li><a href="index.php?action=public_playlists" class="text-white hover:text-emerald-300 transition">Playlists publiques</a></li>
                    <li><a href="index.php?action=playlists" class="text-white hover:text-emerald-300 transition">Mes playlists</a></li>
                    <li><a href="index.php?action=liked_songs" class="text-white hover:text-emerald-300 transition">❤️ Chansons aimées</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'artist'): ?>
                    <li><a href="index.php?action=artist_songs" class="text-white hover:text-emerald-300 transition">Mes chansons</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="index.php?action=admin" class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 transition">Dashboard</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?action=logout" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Contenu -->
    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <?php echo $content; ?>
    </div>

</body>
</html>
