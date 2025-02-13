<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-green-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-white text-2xl font-bold">Spotify Clone</a>
            <ul class="flex space-x-4">
                
                <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="index.php?action=public_playlists" class="text-white">Playlists </a></li>
                <li><a href="index.php?action=songs" class="text-white">Chansons</a></li>
                <li><a href="index.php?action=login" class="text-white">Connexion</a></li>
                <li><a href="index.php?action=register" class="text-white">Inscription</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'user' || $_SESSION['role'] === 'artist')): ?>
                    <li><a href="index.php?action=songs" class="text-white">Chansons</a></li>
                    <li><a href="index.php?action=public_playlists" class="text-white">Playlists publiques</a></li>
                    <li><a href="index.php?action=playlists" class="text-white">Mes playlists</a></li>
                   
                    <li><a href="index.php?action=liked_songs" class="text-white">Chansons aimées</a></li>
                   
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'artist'): ?>

                        <li><a href="index.php?action=artist_songs" class="text-white">Mes chansons</a></li>
                        <!-- <li><a href="index.php?action=upload" class="text-white">Téléverser</a></li> -->
                    <?php endif; ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>

                        <li><a href="index.php?action=admin" class="text-white">Dashbord</a></li>
                        <li><a href="index.php?action=logout" class="text-white">Déconnexion</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'user' || $_SESSION['role'] === 'artist')): ?>
                    <li><a href="index.php?action=logout" class="text-white">Déconnexion</a></li>
                    <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        <?php echo $content; ?>
    </div>
</body>
</html>

