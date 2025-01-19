<?php
session_start();
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CourModelimpl.php';

$course = new CourModelimpl();
 

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Instructor') {
//     header('Location: ../index.php');
//     exit();
// }

 $courseId = $_GET['id'];
  $course->deleteCour($courseId);
      header('location: ./teacherDash.php') 

?>