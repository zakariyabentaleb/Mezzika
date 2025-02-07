<?php
session_start();
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CourModelimpl.php';

$courseModel = new CourModelimpl();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $courseId = intval($_POST['id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = floatval($_POST['price']);
    $difficulty = $_POST['difficulty'];
    $duration = intval($_POST['duration_hours']);
    $categoryId = intval($_POST['category']);

   
    $uploadsDir = '../../../uploads/';
    $thumbnail = null;
    if (!empty($_FILES['file-upload-thumbnail']['name'])) {
        $thumbnailPath = $uploadsDir . basename($_FILES['file-upload-thumbnail']['name']);
        if (move_uploaded_file($_FILES['file-upload-thumbnail']['tmp_name'], $thumbnailPath)) {
            $thumbnail = $thumbnailPath;
        }
    }

    $contentFile = null;
    if (!empty($_FILES['file-upload-document']['name'])) {
        $contentPath = $uploadsDir . basename($_FILES['file-upload-document']['name']);
        if (move_uploaded_file($_FILES['file-upload-document']['tmp_name'], $contentPath)) {
            $contentFile = $contentPath;
        }
    }
    
    try {
        $course=new Cour($courseId, $title, $description, $price, $difficulty, $duration, $categoryId, $thumbnail, $contentFile);
     
        $courseModel->updateCour($course);

        $_SESSION['course_message'] = "Le cours a été mis à jour avec succès.";
        header('Location: ./teacherDash.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['course_message'] = 'Erreur : ' . $e->getMessage();
        header('Location: ./teacherDash.php?id=' . $courseId);
        exit();
    }
}
?>
