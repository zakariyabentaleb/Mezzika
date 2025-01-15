<?php

require_once "../impl/UserControllerimpl.php";
require_once "../../entities/User.php";
require_once "../../entities/Student.php";
require_once "../../entities/Teacher.php";
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\enums\Role.php';

session_start();
$userController = new UserControllerimpl();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    ///////////  UserProcess   //////////

    if (isset($_POST["register"])) {
        $role = $_POST["role"] ?? "";
        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (empty($role) || empty($name) || empty($email) || empty($password)) {
            echo "Tous les champs sont requis.";
            exit();
        }

        if ($role === "student") {
            $role = Role::from($role);
            $person = new Student($email, $hashed_password, $name, $role);
        } elseif ($role === "teacher") {
            $role = Role::from($role);
            $person = new Teacher($email, $hashed_password, $name, $role);
        } else {
            echo "Type d'utilisateur invalide.";
            exit();
        }

        $person->setName($name);
        $person->setEmail($email);
        $person->setPassword($hashed_password);

        try {
            $userController->save($person);
            echo "Utilisateur enregistré avec succès.";
        } catch (Exception $e) {
            echo "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo "Email et mot de passe sont requis.";
            exit();
        }


        $person = new User($email, $password, $name = '', Role::STUDENT); // Vous pouvez ajuster selon votre rôle
        try {

            $userData = $userController->verifyUser($person);

            if ($userData) {
                $_SESSION["user"] = $userData;
                var_dump($_SESSION["user"]);
                echo "Connexion réussie.";
                header("Location: ../../../index.php");
                exit();

            } else {

                echo "Email ou mot de passe incorrect.";
            }
        } catch (Exception $e) {
            echo "Erreur lors de la vérification : " . $e->getMessage();
        }
    }
    
    
    if (isset($_POST["deleteStudent"])) {
    }

    //////////////////////////////////////////////////////////////////
    ///////////  UserProcess   //////////*

    if (isset($_POST["createReservation"])) {
        $reservationcontroller->save();
    }
}
if (isset($_POST['logout'])) {
    session_start(); // Ensure the session is started before destroying it
    session_destroy(); // Destroy the session
    header('Location: http://localhost:8000/app/user/login.php'); // Redirect to login page
    exit(); // Ensure no further code is executed after the redirect
}


///////////////////////////////////////////////////////////////////

if ($_SERVER["REQUEST_METHOD"] = "GET") {
    if (isset($_GET["getUsers"])) {
        $allcateg = $categcontroller->getCatgeories();

        // sesssion set $allcateg

        header("location: view/addcours");
    }
}

?>