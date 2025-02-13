<?php
require_once 'models/Song.php';

class SongController {
    private $songModel;

    public function __construct($pdo) {
        $this->songModel = new Song($pdo);
    }

    public function index() {
        $songs = $this->songModel->getAllSongs();
        if (isset($_SESSION['user_id'])) {
            $playlists = $this->songModel->getPlaylistsByUser($_SESSION['user_id']);
        } else {
            $playlists = [];
        }
        require 'views/songs.php';
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role'] === 'artist') {
            $title = $_POST['title'];
            $artist = $_POST['artist'];
            $file_path = 'uploads/' . $_FILES['song']['name'];
            move_uploaded_file($_FILES['song']['tmp_name'], $file_path);
            
            if ($this->songModel->addSong($title, $artist, $file_path, $_SESSION['user_id'])) {
                header('Location: index.php?action=artist_songs');
            } else {
                echo "Erreur lors de l'ajout de la chanson";
            }
        }
        require 'views/upload.php';
    }

    public function likedSongs() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        $liked_songs = $this->songModel->getLikedSongs($_SESSION['user_id']);
        require 'views/liked_songs.php';
    }

    public function toggleLike() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $song_id = $_POST['song_id'];
            $this->songModel->toggleLike($_SESSION['user_id'], $song_id);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function deleteSong() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'artist')) {
            $song_id = $_POST['song_id'];
            if ($this->songModel->deleteSong($song_id, $_SESSION['user_id'], $_SESSION['role'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Erreur lors de la suppression de la chanson";
            }
        }
    }

    public function artistSongs() {
        if ($_SESSION['role'] === 'artist') {
            $songs = $this->songModel->getSongsByArtist($_SESSION['user_id']);
            require 'views/artist_songs.php';
        } else {
            header('Location: index.php');
        }
    }

    public function editSong() {
        if ($_SESSION['role'] === 'artist') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $song_id = $_POST['song_id'];
                $title = $_POST['title'];
                $artist = $_POST['artist'];
                if ($this->songModel->updateSong($song_id, $title, $artist, $_SESSION['user_id'])) {
                    header('Location: index.php?action=artist_songs');
                } else {
                    echo "Erreur lors de la modification de la chanson";
                }
            } else {
                $song_id = $_GET['id'];
                $song = $this->songModel->getSongById($song_id);
                if ($song && $song['uploaded_by'] === $_SESSION['user_id']) {
                    require 'views/edit_song.php';
                } else {
                    header('Location: index.php?action=artist_songs');
                }
            }
        } else {
            header('Location: index.php');
        }
    }
}
