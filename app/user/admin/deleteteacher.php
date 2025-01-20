<?php
session_start();
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\TeacherModelimpl.php';

$course = new TeacherModelimpl();
 

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Instructor') {
//     header('Location: ../index.php');
//     exit();
// }

 $nom = $_GET['name'];
  $course->deleteTeacher( $nom);
      header('location: ./dashbord.php') 

?>