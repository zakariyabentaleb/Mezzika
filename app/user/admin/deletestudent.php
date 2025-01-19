<?php
session_start();
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\StudentModelimpl.php';

$course = new StudentModuleimpl();
 

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Instructor') {
//     header('Location: ../index.php');
//     exit();
// }

 $nom = $_GET['name'];
  $course->deleteStudent( $nom);
      header('location: ./dashbord.php') 

?>