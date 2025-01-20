<?php
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CourModelimpl.php';
require_once('C:\Users\youco\Desktop\iLearN-platform\app\entities\Cours.php');
session_start();

$courseModel = new CourModelimpl();
$courseId = $_GET['id'];

// Récupérer les détails du cours
$course = $courseModel->getCourseById($courseId);
if (!$course) {
    echo "<div class='text-red-500 text-center mt-6'>Cours non trouvé.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Modifier le Cours</h1>
        <form method="POST" action="editCourse1.php" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="id" value="<?= $course[0]->id; ?>">

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titre :</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($course[0]->titre); ?>" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description :</label>
                <textarea id="description" name="description" 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required><?= htmlspecialchars($course[0]->description); ?></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix :</label>
                    <input type="number" id="price" name="price" value="<?= $course[0]->price; ?>" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="difficulty" class="block text-sm font-medium text-gray-700">Difficulté :</label>
                    <input type="text" id="difficulty" name="difficulty" value="<?= $course[0]->Difficulty; ?>" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Durée (heures) :</label>
                    <input type="number" id="duration" name="duration_hours" value="<?= $course[0]->Duration; ?>" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Catégorie :</label>
                    <input type="text" id="category" name="category" value="<?= $course[0]->category_name; ?>" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Miniature actuelle :</label>
                <div class="mt-2">
                    <img src="<?= $course[0]->images; ?>" alt="Miniature" class="w-24 h-auto rounded-md shadow-md">
                </div>
                <label for="thumbnail" class="block mt-4 text-sm font-medium text-gray-700">Nouvelle miniature (facultatif) :</label>
                <input type="file" id="thumbnail" name="file-upload-thumbnail" 
                       class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contenu actuel :</label>
                <div class="mt-2">
                    <a href="<?= $course[0]->contenu; ?>" target="_blank" 
                       class="text-blue-600 hover:text-blue-800 underline">Télécharger le contenu</a>
                </div>
                <label for="document" class="block mt-4 text-sm font-medium text-gray-700">Nouveau contenu (facultatif) :</label>
                <input type="file" id="document" name="file-upload-document" 
                       class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="w-full bg-blue-600 text-white font-medium py-2 rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</body>
</html>

