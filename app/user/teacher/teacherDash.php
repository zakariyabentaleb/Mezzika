<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\TeacherModelimpl.php');
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CategoryModelimpl.php');
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\TagModelimpl.php');

session_start();
// if ($_SESSION['id']['role'] != 'teacher') {
//     header('Location: ../index.php');
// }
$res = new TeacherModelimpl();
$teacherid = $_SESSION['user']['id'];
$course = $res->getCoursesWithDetails($teacherid);
// var_dump($course);
 $Course=$res->getEnrolledStudentsCount($teacherid);
$categories = new CategoryModelimpl();
$results = $categories->getCategories();
// var_dump($results);
$tags = new TagModelimpl();
$resultss = $tags->getTags();
// var_dump($resultss);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.svg">
    <script src="../assets/scripts/instructorDash.js" defer></script>
    <style>
        .text-gradient {
            background: linear-gradient(to right, #f2b212, #fadf10);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="min-h-screen ">
    <!-- Header -->
    <header class="border-b bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a href="../index.php">
                    <img src="../assets/images/Youdemy_Logo.svg" alt="Youdemy Platform">
                </a>
                <nav class="hidden md:flex items-center space-x-6">
                    <?php ?>
                    <a href="" class="text-gray-900 hover:text-blue-500 transition-colors">

                    </a>
                    <?php ?>
                </nav>
                <div class="flex items-center space-x-4">
                    <?php if (!$_SESSION["user"]) { ?>
                        <a href="./login.php"
                            class="p-2 px-4 bg-blue-400 text-white rounded-full hover:bg-white hover:text-blue-400 hover:border hover:border-blue-400 transition-colors">Login</a>
                        <a href="./register.php"
                            class="p-2 px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">Register</a>
                        <?php
                    } else {

                        ?>
                        <a href="./logout.php"
                            class="p-2 px-4 bg-red-400 text-white rounded-full hover:bg-white hover:text-red-400 hover:border hover:border-red-400 transition-colors">Logout</a>
                        <a href="./logout.php"
                            class="p-2 px-4 bg-red-400 text-white rounded-full hover:bg-white hover:text-red-400 hover:border hover:border-red-400 transition-colors"><?php echo $_SESSION['user']['nom'] ?></a>

                    <?php } ?>
                </div>
            </div>
        </div>
    </header>

    <div class=" mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg border">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="ri-book-open-line text-2xl text-blue-400"></i>
                        </div>
                          <?php foreach ($course as $cours) { ?>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Courses</dt>
                                <dd class="text-3xl font-semibold text-gray-900"> <?= $cours->getTotalRows() ?></dd>
                            </dl>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg border">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="ri-user-line text-2xl text-blue-400"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Enrolled Students</dt>
                                <dd class="text-3xl font-semibold text-gray-900">
                                    <?php echo ($Course) ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg border">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="ri-bar-chart-line text-2xl text-blue-400"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Completion Rate</dt>
                                <dd class="text-3xl font-semibold text-gray-900">87%</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900">Course Management</h2>
                <button id="newCourseBtn"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-blue-400 hover:bg-blue-500">
                    <i class="ri-add-line mr-2"></i>
                    New Course
                </button>
            </div>

            <div class="border-t border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Students</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <?php  foreach ($course as $cours) { ?>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                     <?= $cours->gettitre() ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                      
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">

                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-4">
                                        <i class="ri-edit-line text-lg"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="ri-delete-bin-line text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="bg-white shadow rounded-lg border" id="add">
            <div class="px-4 py-5 sm:px-6 cursor-pointer flex justify-between items-center" id="toggleFormHeader">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Add New Course</h3>
                <i class="ri-arrow-down-s-line text-2xl text-gray-500 transition-transform duration-300"
                    id="toggleIcon"></i>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6" id="courseForm">
                <form class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-4">Title</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full rounded-md p-2 border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 mb-4">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="mt-1 block w-full rounded-md border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-4">Price</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                                <input type="number" name="price" id="price" min="0" step="0.01"
                                    class="mt-1 block w-full rounded-md p-2 pl-7 border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div>
                            <label for="difficulty"
                                class="block text-sm font-medium text-gray-700 mb-4">Difficulty</label>
                            <select id="difficulty" name="difficulty"
                                class="mt-1 block w-full rounded-md p-2 border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-4">Duration</label>
                            <div class="flex space-x-2">
                                <div class="flex-1">
                                    <div class="relative">
                                        <input type="number" name="duration_hours" id="duration_hours" min="0"
                                            placeholder="0"
                                            class="mt-1 block w-full rounded-md p-2 pr-14 border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center">
                                        <span
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 text-sm">hours</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="relative">
                                        <input type="number" name="duration_minutes" id="duration_minutes" min="0"
                                            max="59" placeholder="0"
                                            class="mt-1 block w-full rounded-md p-2 pr-16 border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center">
                                        <span
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 text-sm">mins</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="thumbnail-upload">
                        <label class="block my-4 text-sm font-medium text-gray-700">Thumbnail </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-orange-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload-thumbnail"
                                        class="relative cursor-pointer text-center bg-white rounded-md font-medium text-blue-400 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span class="text-center">Upload thumbnail</span>
                                        <input id="file-upload-thumbnail" name="file-upload-thumbnail" type="file"
                                            class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">Image files (JPG/PNG) up to 2MB</p>
                                <p id="thumbnail-file-name" class="text-xs text-gray-700 mt-2"></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-4">Category</label>
                        <select id="category" name="category"
                            class="mt-1 block p-2 w-full rounded-md border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <?php
                            foreach ($results as $result) {
                                echo "<option value=\"" . $result->getId() . "\">" . $result->getnom() . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Available Tags</label>
                        <div id="available-tags" class="space-y-2 space-x-1">
                            <?php
                            foreach ($resultss as $tag) {
                                echo "<div class='tag-item  space-x-2 inline-block p-2 px-4 border border-blue-400 rounded-full cursor-pointer hover:bg-blue-400' data-tag-id='" . $tag->getId() . "'>
                                     <span class='tag-name'>" .$tag->getnom() . "</span>
                                     </div>";
                            }
                            ?>
                        </div>

                        <label for="selected-tags" class="block text-sm font-medium text-gray-700 mt-4 mb-2">Selected
                            Tags</label>
                        <div id="selected-tags" class="space-y-2 space-x-1">
                        </div>

                        <input type="hidden" name="tags[]" id="selected-tags-hidden">
                        <p class="text-xs text-gray-500 mt-1">Click on a tag to select or remove it.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-4">Content Type</label>
                        <div>

                            <select id="content-type"
                                class="mt-1 block w-full rounded-md p-2 border border-orange-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                <option value="">-- Select content type --</option>
                                <option value="video">Video</option>
                                <option value="document">Document</option>
                            </select>
                        </div>

                        <div id="video-upload" class="hidden">
                            <label class="block my-4 text-sm font-medium text-gray-700">Video :</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-orange-300 border-dashed rounded-md">
                                <div class="space-y-1">
                                    <div class="flex text-sm text-gray-600 text-center justify-center">
                                        <label for="file-upload-video"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-400 hover:text-blue-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload video</span>
                                            <input id="file-upload-video" name="file-upload-video" type="file"
                                                class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">MP4/AVI file up to 10MB</p>
                                    <p id="file-name" class="text-xs text-gray-700 mt-2"></p>
                                </div>
                            </div>
                        </div>

                        <div id="document-upload" class="hidden">
                            <label class="block my-4 text-sm font-medium text-gray-700">Document :</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-orange-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload-document"
                                            class="relative cursor-pointer text-center bg-white rounded-md font-medium text-blue-400 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span class="text-center">Upload file</span>
                                            <input id="file-upload-document" name="file-upload-document" type="file"
                                                class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF document up to 10MB</p>
                                    <p id="document-file-name" class="text-xs text-gray-700 mt-2"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </>

</body>

</html>