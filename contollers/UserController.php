<?php
require_once 'models/User.php';
require_once 'models/Song.php';
require_once 'models/Playlist.php';
class UserController {
    private $userModel;
    private $songModel;
    private $playlistModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
        $this->songModel = new Song($pdo);
        $this->playlistModel = new Playlist($pdo);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            
            if ($this->userModel->register($username, $email, $password, $role)) {
                header('Location: index.php?action=login');
            } else {
                echo "Erreur lors de l'inscription";
            }
        }
        require 'views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = $this->userModel->login($email, $password);
            if ($user === 'banned') {
                require 'views/banned.php';
                exit(); 
            } elseif ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php');
            } else {
                echo "Email ou mot de passe incorrect";
            }
        }
        require 'views/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
    }

    public function adminPanel() {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: index.php');
            exit();
        }
        $users = $this->userModel->getAllUsers();
        $songs = $this->songModel->getAllSongs();
        $playlists = $this->playlistModel->getAllPlaylists();
        require 'views/admin.php';
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
        }}
    public function toggleUserStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role'] === 'admin') {
            $user_id = $_POST['user_id'];
            $this->userModel->toggleUserStatus($user_id);
            header('Location: index.php?action=admin');
        }
    }
}

