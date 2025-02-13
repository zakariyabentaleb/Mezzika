<?php
class Song {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllSongs() {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

    $stmt = $this->pdo->prepare("SELECT songs.*, 
                                   (CASE WHEN liked_songs.user_id IS NOT NULL THEN 1 ELSE 0 END) AS is_liked 
                             FROM songs 
                             LEFT JOIN liked_songs ON songs.id = liked_songs.song_id 
                             AND liked_songs.user_id = ?");
    $stmt->execute([$user_id]);

    return $stmt->fetchAll();
}


    public function addSong($title, $artist, $file_path, $uploaded_by) {
        $stmt = $this->pdo->prepare("INSERT INTO songs (title, artist, file_path, uploaded_by) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $artist, $file_path, $uploaded_by]);
    }

    public function getLikedSongs($user_id) {
        $stmt = $this->pdo->prepare("SELECT songs.* FROM songs JOIN liked_songs ON songs.id = liked_songs.song_id WHERE liked_songs.user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function toggleLike($user_id, $song_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM liked_songs WHERE user_id = ? AND song_id = ?");
        $stmt->execute([$user_id, $song_id]);
        
        if ($stmt->rowCount() > 0) {
            $stmt = $this->pdo->prepare("DELETE FROM liked_songs WHERE user_id = ? AND song_id = ?");
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO liked_songs (user_id, song_id) VALUES (?, ?)");
        }
        
        return $stmt->execute([$user_id, $song_id]);
    }
    public function deleteSong($song_id, $user_id, $role) {
    try {
        $this->pdo->beginTransaction();

        // Supprimer les références dans playlist_songs
        $stmt = $this->pdo->prepare("DELETE FROM playlist_songs WHERE song_id = ?");
        $stmt->execute([$song_id]);

        // Supprimer les références dans liked_songs
        $stmt = $this->pdo->prepare("DELETE FROM liked_songs WHERE song_id = ?");
        $stmt->execute([$song_id]);

        // Supprimer la chanson de la table songs
        if ($role === 'admin' || $role === 'artist') {
            $stmt = $this->pdo->prepare("DELETE FROM songs WHERE id = ?");
            $stmt->execute([$song_id]);
        } else {
            $stmt = $this->pdo->prepare("DELETE FROM songs WHERE id = ? AND uploaded_by = ?");
            $stmt->execute([$song_id, $user_id]);
        }

        $this->pdo->commit();
        return true;
    } catch (Exception $e) {
        $this->pdo->rollBack();
        throw $e;
    }
}


    public function getPlaylistsByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM playlists WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function getSongsByArtist($artist_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM songs WHERE uploaded_by = ?");
        $stmt->execute([$artist_id]);
        return $stmt->fetchAll();
    }

    public function getSongById($song_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM songs WHERE id = ?");
        $stmt->execute([$song_id]);
        return $stmt->fetch();
    }

    public function updateSong($song_id, $title, $artist, $user_id) {
        $stmt = $this->pdo->prepare("UPDATE songs SET title = ?, artist = ? WHERE id = ? AND uploaded_by = ?");
        return $stmt->execute([$title, $artist, $song_id, $user_id]);
    }
}
