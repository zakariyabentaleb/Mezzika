<?php
session_start();
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CourModelimpl.php';

$course = new CourModelimpl();
echo "hi";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = floatval($_POST['price']);
    $difficulty = $_POST['difficulty'];
    $duration = intval($_POST['duration_hours']);
    $categoryId = intval($_POST['category']);
  
    $tags = [];
    if (isset($_POST['selectedTags']) && !empty($_POST['selectedTags'])) {
        $tagArray = explode(',', $_POST['selectedTags']);
        $tags = array_map('intval', $tagArray);
        $tags = array_filter($tags, function ($tag) {
            return $tag > 0;
        });
    }

    $contentType = $_POST['content-type'];
    $status = 'Published';

    // Gestion des fichiers téléchargés
    $uploadsDir = '../../../uploads/';
    $thumbnail = null;
    if (!empty($_FILES['file-upload-thumbnail']['name'])) {
        $thumbnailPath = $uploadsDir . basename($_FILES['file-upload-thumbnail']['name']);
        if (move_uploaded_file($_FILES['file-upload-thumbnail']['tmp_name'], $thumbnailPath)) {
            $thumbnail = $thumbnailPath;
        }
    }

    $contentFile = null;
    if ($contentType === 'video' && !empty($_FILES['file-upload-video']['name'])) {
        $contentPath = $uploadsDir . basename($_FILES['file-upload-video']['name']);
        if (move_uploaded_file($_FILES['file-upload-video']['tmp_name'], $contentPath)) {
            $contentFile = $contentPath;
        }
    } elseif ($contentType === 'document' && !empty($_FILES['file-upload-document']['name'])) {
        $contentPath = $uploadsDir . basename($_FILES['file-upload-document']['name']);
        if (move_uploaded_file($_FILES['file-upload-document']['tmp_name'], $contentPath)) {
            $contentFile = $contentPath;
        }
    }

    $instructorId=$_SESSION['user']['id'];
    echo $instructorId;
    // Création de l'objet Cour
    $cour = new Cour(
        $title,
        $description,
        $contentFile, // Fichier contenu (vidéo ou document)
        null ,
        $price,
        $categoryId,
        $thumbnail,
        $contentFile,
        null,
        $instructorId, 
        $difficulty,
        $duration,
        null // L'ID est laissé vide ici
    );
    echo $cour->getcontenu();
    echo $cour->getInstructorId();
    try {
        echo 'try';
        $result = $course->addCour( $cour);
        header(header: 'Location: ./teacherDash.php');
        
        
    } catch (Exception $e) {
        $_SESSION['course_message'] = 'Error: ' . $e->getMessage();
    }
    
    exit();
}
?>
