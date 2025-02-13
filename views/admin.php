<h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Panneau d'administration</h2>

<!-- Section Gestion des utilisateurs -->
<h3 class="text-2xl font-semibold text-gray-700 mb-4">Gestion des utilisateurs</h3>
<table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden mb-8">
    <thead>
        <tr class="bg-gray-100 text-left text-gray-600">
            <th class="px-6 py-4 font-medium">Nom d'utilisateur</th>
            <th class="px-6 py-4 font-medium">Email</th>
            <th class="px-6 py-4 font-medium">Rôle</th>
            <th class="px-6 py-4 font-medium">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-4"><?php echo htmlspecialchars($user['username']); ?></td>
                <td class="px-6 py-4"><?php echo htmlspecialchars($user['email']); ?></td>
                <td class="px-6 py-4"><?php echo htmlspecialchars($user['role']); ?></td>
                <td class="px-6 py-4">
                    <form action="index.php?action=toggle_user_status" method="post" class="inline">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-400 transition duration-300">
                            <?php echo $user['is_banned'] ? 'Débloquer' : 'Bannir'; ?>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Section Gestion des chansons -->
<h3 class="text-2xl font-semibold text-gray-700 mb-4">Gestion des chansons</h3>
<table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden mb-8">
    <thead>
        <tr class="bg-gray-100 text-left text-gray-600">
            <th class="px-6 py-4 font-medium">Titre</th>
            <th class="px-6 py-4 font-medium">Artiste</th>
            <th class="px-6 py-4 font-medium">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($songs as $song): ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-4"><?php echo htmlspecialchars($song['title']); ?></td>
                <td class="px-6 py-4"><?php echo htmlspecialchars($song['artist']); ?></td>
                <td class="px-6 py-4">
                    <form action="index.php?action=delete_song" method="post" class="inline">
                        <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400 transition duration-300">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Section Gestion des playlists -->
<h3 class="text-2xl font-semibold text-gray-700 mb-4">Gestion des playlists</h3>
<table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
    <thead>
        <tr class="bg-gray-100 text-left text-gray-600">
            <th class="px-6 py-4 font-medium">Nom</th>
            <th class="px-6 py-4 font-medium">Créée par</th>
            <th class="px-6 py-4 font-medium">Statut</th>
            <th class="px-6 py-4 font-medium">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($playlists as $playlist): ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-4"><?php echo htmlspecialchars($playlist['name']); ?></td>
                <td class="px-6 py-4"><?php echo htmlspecialchars($playlist['username']); ?></td>
                <td class="px-6 py-4"><?php echo $playlist['is_public'] ? 'Publique' : 'Privée'; ?></td>
                <td class="px-6 py-4">
                    <form action="index.php?action=admin_delete_playlist" method="post" class="inline">
                        <input type="hidden" name="playlist_id" value="<?php echo $playlist['id']; ?>">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400 transition duration-300">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
