<?php
session_start();
require_once 'config/database.php';
require_once './contollers/UserController.php';
require_once './contollers/SongController.php';
require_once './contollers/PlaylistController.php';




$userController = new UserController($pdo);
$songController = new SongController($pdo);
$playlistController = new PlaylistController($pdo);

$action = $_GET['action'] ?? 'home';

ob_start();

switch ($action) {
    case 'register':
        $userController->register();
        break;
    case 'login':
        $userController->login();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'songs':
        $songController->index();
        break;
    case 'upload':
        $songController->upload();
        break;
    case 'playlists':
        $playlistController->index();
        break;
    case 'create_playlist':
        $playlistController->create();
        break;
    case 'view_playlist':
        $playlistController->view();
        break;
    case 'edit_playlist':
        $playlistController->edit();
        break;
    case 'delete_playlist':
        $playlistController->deletep();
        break;
    case 'add_song_to_playlist':
        $playlistController->addSong();
        break;
    case 'remove_song_from_playlist':
        $playlistController->removeSong();
        break;
    case 'toggle_follow_playlist':
        $playlistController->toggleFollow();
        break;
    case 'liked_songs':
        $songController->likedSongs();
        break;
    case 'toggle_like':
        $songController->toggleLike();
        break;
    case 'artist_songs':
        $songController->artistSongs();
        break;
    case 'edit_song':
        $songController->editSong();
        break;
    case 'delete_song':
        $songController->deleteSong();
        break;
    case 'public_playlists':
        $playlistController->publicPlaylists();
        break;
    case 'admin':
        $userController->adminPanel();
        break;
    case 'toggle_user_status':
        $userController->toggleUserStatus();
        break;
    case 'admin_delete_playlist':
         $userController->delete();
        break;
    
     
    case 'banned':
        require 'views/banned.php';
        break;
    default:
        require 'views/home.php';
}

$content = ob_get_clean();
require 'views/layout.php';

