<?php
class Playlist {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createPlaylist($user_id, $name, $is_public = 0) {
    $is_public = (int)$is_public; 
    $stmt = $this->pdo->prepare("INSERT INTO playlists (user_id, name, is_public) VALUES (?, ?, ?)");
    return $stmt->execute([$user_id, $name, $is_public]);
}

    public function getPlaylistsByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM playlists WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function getPlaylistById($playlist_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM playlists WHERE id = ?");
        $stmt->execute([$playlist_id]);
        return $stmt->fetch();
    }

    public function getSongsInPlaylist($playlist_id) {
        $stmt = $this->pdo->prepare("SELECT songs.* FROM songs JOIN playlist_songs ON songs.id = playlist_songs.song_id WHERE playlist_songs.playlist_id = ?");
        $stmt->execute([$playlist_id]);
        return $stmt->fetchAll();
    }

    public function addSongToPlaylist($playlist_id, $song_id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT user_id FROM playlists WHERE id = ?");
        $stmt->execute([$playlist_id]);
        $playlist = $stmt->fetch();

        if ($playlist && $playlist['user_id'] == $user_id) {
            $stmt = $this->pdo->prepare("INSERT INTO playlist_songs (playlist_id, song_id) VALUES (?, ?)");
            return $stmt->execute([$playlist_id, $song_id]);
        }
        return false;
    }

    public function removeSongFromPlaylist($playlist_id, $song_id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT user_id FROM playlists WHERE id = ?");
        $stmt->execute([$playlist_id]);
        $playlist = $stmt->fetch();

        if ($playlist && $playlist['user_id'] == $user_id) {
            $stmt = $this->pdo->prepare("DELETE FROM playlist_songs WHERE playlist_id = ? AND song_id = ?");
            return $stmt->execute([$playlist_id, $song_id]);
        }
        return false;
    }

    public function updatePlaylist($playlist_id, $user_id, $name, $is_public = 0) {
    $is_public = (int)$is_public;  
    $stmt = $this->pdo->prepare("UPDATE playlists SET name = ?, is_public = ? WHERE id = ? AND user_id = ?");
    return $stmt->execute([$name, $is_public, $playlist_id, $user_id]);
}


public function deletePlaylist($playlist_id, $user_id,$role) {
   
    $stmt = $this->pdo->prepare("DELETE FROM playlist_songs WHERE playlist_id = ?");
    $stmt->execute([$playlist_id]);

    $sql = "DELETE FROM followed_playlists WHERE playlist_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$playlist_id]);

    if ($role === 'admin' || $role === 'artist') {
        $stmt = $this->pdo->prepare("DELETE FROM playlists WHERE id = ?");
        return $stmt->execute([$playlist_id]);
    } else {
        $stmt = $this->pdo->prepare("DELETE FROM playlists WHERE id = ? AND user_id = ?");
        return $stmt->execute([$playlist_id, $user_id]);
    }
}
public function deletePlaylistP($playlist_id, $user_id) {
        $stmt = $this->pdo->prepare("DELETE FROM playlist_songs WHERE playlist_id = ?");
        $stmt->execute([$playlist_id]);

        $stmt = $this->pdo->prepare("DELETE FROM playlists WHERE id = ? AND user_id = ?");
        return $stmt->execute([$playlist_id, $user_id]);
    }
    public function isFollowing($user_id, $playlist_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM followed_playlists WHERE user_id = ? AND playlist_id = ?");
        $stmt->execute([$user_id, $playlist_id]);
        return $stmt->rowCount() > 0;
    }

    public function toggleFollowPlaylist($user_id, $playlist_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM followed_playlists WHERE user_id = ? AND playlist_id = ?");
        $stmt->execute([$user_id, $playlist_id]);
        
        if ($stmt->rowCount() > 0) {
            $stmt = $this->pdo->prepare("DELETE FROM followed_playlists WHERE user_id = ? AND playlist_id = ?");
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO followed_playlists (user_id, playlist_id) VALUES (?, ?)");
        }
        
        return $stmt->execute([$user_id, $playlist_id]);
    }

   
    public function getFollowedPlaylists($user_id) {
    $stmt = $this->pdo->prepare("SELECT playlists.*, users.username 
        FROM playlists 
        JOIN users ON playlists.user_id = users.id
        JOIN followed_playlists ON playlists.id = followed_playlists.playlist_id
        WHERE followed_playlists.user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}
    public function getPublicPlaylists($user_id) {
        $stmt = $this->pdo->prepare("
            SELECT p.*, u.username, 
            CASE WHEN fp.user_id IS NOT NULL THEN TRUE ELSE FALSE END AS is_following
            FROM playlists p
            JOIN users u ON p.user_id = u.id
            LEFT JOIN followed_playlists fp ON p.id = fp.playlist_id AND fp.user_id = ?
            WHERE p.is_public = TRUE AND p.user_id != ?
            ORDER BY p.created_at DESC
        ");
        $stmt->execute([$user_id, $user_id]);
        return $stmt->fetchAll();
    }
    public function getAllPlaylists() {
        $stmt = $this->pdo->prepare("
            SELECT p.*, u.username
            FROM playlists p
            JOIN users u ON p.user_id = u.id
            ORDER BY p.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

