<?php
require_once 'models/Playlist.php';

class PlaylistController {
    private $playlistModel;

    public function __construct($pdo) {
        $this->playlistModel = new Playlist($pdo);
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        $user_playlists = $this->playlistModel->getPlaylistsByUser($_SESSION['user_id']);
        $followed_playlists = $this->playlistModel->getFollowedPlaylists($_SESSION['user_id']);
        require 'views/playlists.php';
    }


    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $is_public = isset($_POST['is_public']) && $_POST['is_public'] == '1' ? 1 : 0;
        if ($this->playlistModel->createPlaylist($_SESSION['user_id'], $name, $is_public)) {
            header('Location: index.php?action=playlists');
            exit();
        } else {
            echo "Erreur lors de la création de la playlist";
        }
    }
    require 'views/create_playlist.php';
}

    public function view() {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
        $playlist_id = $_GET['id'];
        $playlist = $this->playlistModel->getPlaylistById($playlist_id);
        $songs = $this->playlistModel->getSongsInPlaylist($playlist_id);
        $is_following = $this->playlistModel->isFollowing($userId, $playlist_id);
        require 'views/view_playlist.php';
    }

    public function edit() {
        $playlist_id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $is_public = isset($_POST['is_public']) && $_POST['is_public'] == '1' ? 1 : 0;
            
            if ($this->playlistModel->updatePlaylist($playlist_id, $_SESSION['user_id'], $name, $is_public)) {

                header('Location: index.php?action=playlists');
                exit();
            } else {
                echo "Erreur lors de la modification de la playlist";
            }
        } else {
            $playlist = $this->playlistModel->getPlaylistById($playlist_id);
            if ($playlist && $playlist['user_id'] == $_SESSION['user_id']) {
                require 'views/edit_playlist.php';
            } else {
                header('Location: index.php?action=playlists');
            }
        }
    }

    public function delete() {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: index.php');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'artist') ) {
            $playlist_id = $_POST['playlist_id'];
            $this->playlistModel->deletePlaylist($playlist_id, $_SESSION['user_id'] ,$_SESSION['role']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
}

public function deletep() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $playlist_id = $_POST['playlist_id'];
            if ($this->playlistModel->deletePlaylistp($playlist_id, $_SESSION['user_id'])) {
                header('Location: index.php?action=playlists');
            } else {
                echo "Erreur lors de la suppression de la playlist";
            }
        }
    }

    public function addSong() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $playlist_id = $_POST['playlist_id'];
            $song_id = $_POST['song_id'];
            
            if ($this->playlistModel->addSongToPlaylist($playlist_id, $song_id, $_SESSION['user_id'])) {
                header('Location: index.php?action=view_playlist&id=' . $playlist_id);
            } else {
                echo "Erreur lors de l'ajout de la chanson à la playlist";
            }
        }
    }

    public function removeSong() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $playlist_id = $_POST['playlist_id'];
            $song_id = $_POST['song_id'];
            
            if ($this->playlistModel->removeSongFromPlaylist($playlist_id, $song_id, $_SESSION['user_id'])) {
                header('Location: index.php?action=view_playlist&id=' . $playlist_id);
            } else {
                echo "Erreur lors de la suppression de la chanson de la playlist";
            }
        }
    }

    public function toggleFollow() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $playlist_id = $_POST['playlist_id'];
            
            if ($this->playlistModel->toggleFollowPlaylist($_SESSION['user_id'], $playlist_id)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Erreur lors du suivi/désabonnement de la playlist";
            }
        }
    }
    public function publicPlaylists() {
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $public_playlists = $this->playlistModel->getPublicPlaylists($userId);
    require 'views/public_playlists.php';
}

    
}
