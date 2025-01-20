<?php

require_once "../impl/UserControllerimpl.php";
require_once "../../entities/User.php";
require_once "../../entities/Student.php";
require_once "../../entities/Teacher.php";
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\enums\Role.php';
session_start();
$userController = new UserControllerimpl();
var_dump($_POST); 
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


        $person = new User($email, $password, $name = '', Role::STUDENT);
        try {

            $userData = $userController->verifyUser($person);

            if ($userData) {
                $_SESSION["user"] = $userData;
                var_dump($_SESSION["user"]);
            $role= $_SESSION["user"]["role"];
             switch ($role){
                case 'admin':
                header("Location: ../../user/admin/dashbord.php");
                break;
                case 'student':
                header("Location: ../../../index.php");
                break;
                case 'teacher':
                    header("Location: ../../user/teacher/teacherDash.php");  
                    break;
             }

            } else {

                echo "Email ou mot de passe incorrect.";
            }
        } catch (Exception $e) {
            echo "Erreur lors de la vérification : " . $e->getMessage();
        }
    }
    
    
    

    
   
}
if (isset($_POST['logout'])) {
    session_start(); 
    session_destroy(); 
    header('Location: http://localhost:8000/app/user/login.php');
    exit(); 
}




?>