<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\controller\impl\UserControllerimpl.php');
require_once('C:\Users\youco\Desktop\iLearN-platform\app\enums\Role.php');
$UserModelimpl = new UserModelimpl();
$role = 'teacher';
$role2 = 'student';
$result = $UserModelimpl->fetchUsersByRole($role);
$result2 = $UserModelimpl->fetchUsersByRole($role2);
// var_dump($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blue Dashboard</title>
</head>

<body class="text-blue-900 font-inter">

    <!-- Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-blue-800 p-4 z-50 sidebar-menu transition-transform">
        <a href="#" class="flex items-center pb-4 border-b border-b-blue-700">
            <img src="../../../assets/images/LOGO.svg" alt="Youdemy Platform">
        </a>
        <ul class="mt-4">
            <li class="mb-1 group active">
                <a href="./dashbord.php"
                    class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md">
                    <i class="ri-file-copy-2-fill mr-3 text-lg"></i>
                    <span class="text-sm">Categories</span>
                    <i class="ri-arrow-right-s-line ml-auto"></i>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="./allcours.php"
                    class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md">
                    <i class="ri-file-copy-2-fill mr-3 text-lg"></i>
                    <span class="text-sm">Cours</span>
                    <i class="ri-arrow-right-s-line ml-auto"></i>
                </a>
            </li>

            <li class="mb-1 group">
                <a class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md">
                    <i class="ri-bookmark-line mr-3 text-lg"></i>
                    <span class="text-sm">Tags</span>
                    <i class="ri-arrow-right-s-line ml-auto"></i>
                </a>
            </li>
            <li class="mb-1 group">
                <a class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md">
                    <i class="ri-logout-box-line mr-3 text-lg"></i>
                    <span class="text-sm">Logout</span>
                    <i class="ri-arrow-right-s-line ml-auto"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-blue-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-blue-100 flex items-center shadow-md sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-blue-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="#" class="text-blue-500 hover:text-blue-700 font-medium">Dashboard</a>
                </li>
                <li class="text-blue-600 mr-2 font-medium">/</li>
                <li class="text-blue-600 font-medium">Analytics</li>
            </ul>
        </div>
        <div class="p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Student Card -->
                <div class="bg-white rounded-md border border-blue-200 p-6 shadow-md">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold"><i class="ri-group-fill"></i></div>
                                <div
                                    class="p-1 rounded bg-blue-100 text-blue-600 text-[12px] font-semibold leading-none ml-2">
                                    Teacher</div>
                            </div>
                            <div class="text-sm font-medium text-blue-400">Teacher Details</div>
                        </div>
                    </div>
                    <?php
                    foreach ($result as $res) {
                        ?>
                        <!-- Student Information -->
                        <div
                            class="p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg shadow-xl border border-gray-200 mt-6">
                            <div class="flex items-center">
                                <!-- Student Image -->
                                <div
                                    class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center shadow-inner">
                                    <img src="https://placehold.co/64x64" alt="Student" class="rounded-full">
                                </div>
                                <div class="ml-4">
                                    <!-- Student Details -->
                                    <h2 class="text-xl font-bold text-gray-800 mb-1"><?= $res->getName() ?></h2>
                                    <p class="text-gray-600 text-sm">
                                        <span class="font-semibold text-gray-800">Age:</span> 20
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        <span class="font-semibold text-gray-800">Major:</span> Computer Science
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 border-t border-gray-300 pt-4">
                                <!-- Action Buttons -->
                                <div class="flex justify-end">
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-5 py-2 rounded-full shadow-lg transform transition-transform hover:scale-105"
                                        onclick="deleteStudent('<?= $res->getName() ?>')">
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- Teacher Card -->
                <div class="bg-white rounded-md border border-blue-200 p-6 shadow-md">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold"><i class="ri-group-fill"></i></div>
                                <div
                                    class="p-1 rounded bg-blue-100 text-blue-600 text-[12px] font-semibold leading-none ml-2">
                                    Student</div>
                            </div>
                            <div class="text-sm font-medium text-blue-400">Student Details</div>
                        </div>
                    </div>
                    <?php
                    foreach ($result2 as $res2) {
                        ?>
                        <!-- Teacher Information -->

                        <div
                            class="p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg shadow-xl border border-gray-200 mt-6">
                            <div class="flex items-center">
                                <!-- Student Image -->
                                <div
                                    class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center shadow-inner">
                                    <img src="https://placehold.co/64x64" alt="Student" class="rounded-full">
                                </div>
                                <div class="ml-4">
                                    <!-- Student Details -->
                                    <h2 class="text-xl font-bold text-gray-800 mb-1"><?= $res2->getName() ?></h2>
                                    <p class="text-gray-600 text-sm">
                                        <span class="font-semibold text-gray-800">Age:</span> 20
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        <span class="font-semibold text-gray-800">Major:</span> Computer Science
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 border-t border-gray-300 pt-4">
                                <!-- Action Buttons -->
                                <div class="flex justify-end">
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-5 py-2 rounded-full shadow-lg transform transition-transform hover:scale-105"
                                        onclick="deleteStudent('<?= $res->getName() ?>')">
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- Cours Card -->
                <div class="bg-white rounded-md border border-blue-200 p-6 shadow-md">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold"><i class="ri-group-fill"></i></div>
                                <div
                                    class="p-1 rounded bg-blue-100 text-blue-600 text-[12px] font-semibold leading-none ml-2">
                                    Cours</div>
                            </div>
                            <div class="text-sm font-medium text-blue-400">Cours Details</div>
                        </div>
                    </div>
                    <!-- Cours Information -->
                    <div class="mt-4">
                        <p class="text-gray-600 text-sm">
                            <span class="font-bold text-gray-800">Title:</span> Introduction to AI
                        </p>
                        <p class="text-gray-600 text-sm">
                            <span class="font-bold text-gray-800">Credits:</span> 3
                        </p>
                        <p class="text-gray-600 text-sm">
                            <span class="font-bold text-gray-800">Instructor:</span> Prof. Alan Turing
                        </p>
                        <a href="#" class="text-blue-500 text-sm font-medium hover:text-blue-600 mt-2 inline-block">View
                            Details</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>