<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.svg">
    <script src="../assets/scripts/main.js" defer></script>
</head>

<body>
    <style>
        #toolbarContainer .toolbarButton,
        #toolbarContainer .splitToolbarButton,
        #toolbarContainer .dropdownToolbarButton,
        #toolbarContainer .secondaryToolbarButton {
            display: none !important;
        }

        #toolbarContainer #pageNumber,
        #toolbarContainer #numPages,
        #toolbarContainer #zoomIn,
        #toolbarContainer #zoomOut,
        #toolbarContainer #previous,
        #toolbarContainer #next {
            display: inline-block !important;
        }

        #viewerContainer,
        #mainContainer,
        .pdfViewer {
            background-color: #f5f5f5 !important;
            max-width: 100% !important;
            width: 100% !important;
        }

        .page {
            border: none !important;
            margin: 10px auto !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            width: 90% !important;
            max-width: 1200px !important;
        }

        #outerContainer {
            width: 100% !important;
            max-width: 100% !important;
        }

        #toolbarContainer {
            background-color: #333 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            width: 100% !important;
        }

        #pageNumber {
            background-color: transparent !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        #download,
        #print {
            display: none !important;
        }

        #viewerContainer::-webkit-scrollbar {
            width: 8px;
        }

        #viewerContainer::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #viewerContainer::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        #viewerContainer::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .pdfViewer .page {
            margin: 1px auto -8px auto !important;
            scale: 1 !important;
        }
    </style>

    <!-- Header container -->
    <div class="flex flex-col">

        <div class="hidden md:block w-full bg-blue-600 text-white">
            <div class="container mx-auto px-4 py-2">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-6">
                        <span class="flex items-center">
                            <i class="ri-phone-line mr-2"></i> +212 772508881
                        </span>
                        <span class="flex items-center">
                            <i class="ri-mail-line mr-2"></i> contact@youdemy.com
                        </span>
                    </div>
                    <span class="flex items-center">
                        <i class="ri-map-pin-line mr-2"></i> Massira N641 Safi, Morocco
                    </span>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="border-b bg-white">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-4">
                    <a href="../index.php">
                        <img src="../../assets/images/LOGO.svg" alt="Youdemy Platform">
                    </a>
                    <nav class="hidden md:flex items-center space-x-6">
                        <?php ?>
                        <a href=" " class="text-gray-900 hover:text-blue-500 transition-colors">

                        </a>
                        <?php ?>
                    </nav>
                    <?php

                    if (!isset($_SESSION["user"])) {
                        ?>
                        
                        <div class="flex items-center space-x-4">
                            <?php ?>
                            <button
                                class="p-2 px-4 bg-blue-400 text-white rounded-full hover:bg-white hover:text-blue-400 hover:border hover:border-blue-400 transition-colors">
                                <a href="./login.php">Login</a>
                            </button>
                            <button
                                class="p-2 px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">
                                <a href="./register.php">Register</a>
                            </button>

                            <button id="mobile-menu-btn" class="p-2 hover:text-blue-500 transition-colors md:hidden">
                                <i class="ri-menu-4-fill text-2xl"></i>
                            </button>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="flex items-center space-x-4">
                            <form action="\app\controller\base\baseController.php" method="POST">
                                <button type="submit" name="logout"
                                    class="p-2 px-4 bg-blue-600 text-white rounded-full hover:bg-white hover:text-blue-600 hover:border hover:border-blue-600 transition-colors">
                                    Log out
                                </button>
                                <button
                                    class="p-2 px-4 border border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition-colors">
                                    <a href="../app/user/register.php"><?php echo $_SESSION["user"]['nom'] ?></a>
                                </button>
                            </form>

                            <button id="mobile-menu-btn" class="p-2 hover:text-blue-500 transition-colors md:hidden">
                                <i class="ri-menu-4-fill text-2xl"></i>
                            </button>
                        </div>
                </div>
            </div>
        </header>
    </div>

    <!-- Breadcrumbs -->
    <div class="sm:px-6 lg:px-8 py-4">
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <a href="../index.php" class="hover:text-gray-700">Home</a>
            <i class="ri-arrow-right-s-line"></i>
            <a href="../pages/mycourses.php" class="hover:text-gray-700">My Courses</a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="text-gray-700"> </span>
        </div>
    </div>

    <!--  course video section  -->
    <div class="sm:px-6 lg:px-8 py-4 w-full flex gap-4">
        <!-- video view -->
        <div class="w-[70%] border p-2 rounded-lg shadow-sm px-6 pb-8 pt-6">
            <h3 class="font-semibold mb-2 text-xl pb-3 border-b text-blue-400 mb-3">Course Video</h3>
            <div class="relative aspect-video rounded-lg overflow-hidden ">
                <video controls poster="../../assets/images/cover4.png " width="100%">
                    <source src="../../assets/images/videos/videoplayback.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <!-- sidebar -->
        <div class="w-[30%]">
            <div>
                <div class="bg-white rounded-lg border shadow-sm p-6 ">
                    <div>
                        <div class="mb-8">
                            <h3 class="font-semibold mb-2 text-xl border-b pb-3 text-blue-400">Course Info
                            </h3>
                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-layout-grid-line text-blue-400"></i>
                                    <span>Category</span>
                                </div>
                                <span> </span>
                            </div>

                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-signal-tower-line text-blue-400"></i>
                                    <span>Difficulty</span>
                                </div>
                                <span> </span>
                            </div>
                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-user-line text-blue-400"></i>
                                    <span>Students</span>
                                </div>
                                <span> </span>
                            </div>
                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-time-line text-blue-400"></i>
                                    <span>Duration</span>
                                </div>
                                <span> </span>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold mb-2 text-xl pb-3 text-blue-400">Resources</h3>
                            <div class="space-y-2 mb-8">
                                <button
                                    class="w-full flex items-center justify-center space-x-2 bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-100">
                                    <i class="ri-download-cloud-line"></i>
                                    <span>Download Course</span>
                                </button>
                            </div>

                            <div>
                                <h3 class="font-semibold mb-2 text-xl border-b pb-3 text-blue-400">Instructor
                                </h3>
                                <div class="flex items-center space-x-3 ">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center">
                                        <img src="../uploads/avatars/<?php echo htmlspecialchars(isset($instructorInfo['avatarImg']) && $instructorInfo['avatarImg'] !== null ? $instructorInfo['avatarImg'] : 'simple.png'); ?>"
                                            class="rounded-full object-cover">
                                    </div>
                                    <div>
                                        <div class="font-medium">
                                            <?php ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?php ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- course document section -->
    <div class="sm:px-6 lg:px-8 py-4 w-full flex gap-4">
        <!-- video view -->
        <div class="w-[70%] border p-2 rounded-lg shadow-sm px-6 pb-8 pt-6">
            <h3 class="font-semibold mb-2 text-xl pb-3 border-b text-blue-400 mb-3">Course Document</h3>
            <div class="relative aspect-video rounded-lg overflow-hidden ">
                <iframe src="../../assets/images/pdfs/pp.pdf" width="100%" height="600px"></iframe>
            </div>
        </div>
        <!-- sidebar -->
        <div class="w-[30%]">
            <div>
                <div class="bg-white rounded-lg border shadow-sm p-6 ">
                    <div>
                        <div class="mb-8">
                            <h3 class="font-semibold mb-2 text-xl border-b pb-3 text-blue-400">Course Info
                            </h3>
                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-layout-grid-line text-blue-400"></i>
                                    <span>Category</span>
                                </div>
                                <span><?= htmlspecialchars($courseDetails['category_name'] ?? 'General') ?></span>
                            </div>

                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-signal-tower-line text-blue-400"></i>
                                    <span>Difficulty</span>
                                </div>
                                <span><?= htmlspecialchars($courseDetails['Difficulty'] ?? 'Unknown') ?></span>
                            </div>
                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-user-line text-blue-400"></i>
                                    <span>Students</span>
                                </div>
                                <span><?= htmlspecialchars($courseDetails['student_count'] ?? '0') ?></span>
                            </div>
                            <div class="flex items-center justify-between py-2 ">
                                <div class="flex items-center gap-2">
                                    <i class="ri-time-line text-blue-400"></i>
                                    <span>Duration</span>
                                </div>
                                <span><?= htmlspecialchars($courseDetails['Duration'] ?? 'Unknown') ?></span>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold mb-2 text-xl pb-3 text-blue-400">Resources</h3>
                            <div class="space-y-2 mb-8">
                                <button
                                    class="w-full flex items-center justify-center space-x-2 bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-100">
                                    <i class="ri-download-cloud-line"></i>
                                    <span>Download Course</span>
                                </button>
                            </div>

                            <div>
                                <h3 class="font-semibold mb-2 text-xl border-b pb-3 text-blue-400">Instructor
                                </h3>
                                <div class="flex items-center space-x-3 ">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center">
                                        <img src="../uploads/avatars/<?php echo htmlspecialchars(isset($instructorInfo['avatarImg']) && $instructorInfo['avatarImg'] !== null ? $instructorInfo['avatarImg'] : 'simple.png'); ?>"
                                            class="rounded-full object-cover">
                                    </div>
                                    <div>
                                        <div class="font-medium">

                                        </div>
                                        <div class="text-sm text-gray-500">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Footer Section -->
    <footer class="bg-blue-10 py-16 ">
        <div class="px-10">
            <div class="mb-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center hover:bg-transparent hover:border hover:border-blue-400 hover:scale-95 transition-transform duration-300">
                        <i class="ri-team-line text-2xl text-blue-500 mb-2"></i>
                        <p class="font-medium">Community</p>
                    </div>
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center hover:bg-transparent hover:border hover:border-blue-400 hover:scale-95 transition-transform duration-300">
                        <i class="ri-link text-2xl text-blue-500 mb-2"></i>
                        <p class="font-medium">Referrals</p>
                    </div>
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center hover:bg-transparent hover:border hover:border-blue-400 hover:scale-95 transition-transform duration-300">
                        <i class="ri-book-2-line text-2xl text-blue-500 mb-2"></i>
                        <p class="font-medium">Assignments</p>
                    </div>
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center  hover:bg-transparent hover:border hover:border-blue-400 hover:scale-95 transition-transform duration-300">
                        <i class="ri-medal-line text-2xl text-blue-500 mb-2"></i>
                        <p class="font-medium">Certificates</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <img src="../../assets/images/LOGO.svg" height="200" width="200">
                    </div>
                    <p class="text-gray-600 mb-6">Eros in cursus turpis massa tincidunt Faucibus scelerisque
                        eleifend
                        vulputate sapien nec sagittis.</p>
                    <div class="flex gap-4">
                        <div
                            class="h-9 w-9 bg-blue-400 flex justify-center items-center rounded-lg hover:border hover:border-blue-400 hover:bg-transparent hover:text-blue-400">
                            <a href="#" class="p-2 transition-colors">
                                <i class="ri-facebook-fill text-xl "></i>
                            </a>
                        </div>

                        <div
                            class="h-9 w-9 bg-blue-400 flex justify-center items-center rounded-lg hover:border hover:border-blue-400 hover:bg-transparent hover:text-blue-400">
                            <a href="#" class="p-2 transition-colors">
                                <i class="ri-instagram-line text-xl "></i>
                            </a>
                        </div>

                        <div
                            class="h-9 w-9 bg-blue-400 flex justify-center items-center rounded-lg hover:border hover:border-blue-400 hover:bg-transparent hover:text-blue-400">
                            <a href="#" class="p-2 transition-colors">
                                <i class="ri-youtube-fill text-xl "></i>
                            </a>
                        </div>

                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Pages</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Home</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Courses</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">My Account</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">About</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Pricing</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Features</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Sign In / Register</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Our Newsletter</h3>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Enter Your Email"
                            class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                        <button
                            class="px-6 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors">Submit</button>
                    </div>
                    <p class="text-sm text-gray-600 mt-4">
                        By clicking "Subscribe", you agree to our
                        <a href="#" class="text-gray-900 hover:underline">Privacy Policy</a>.
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-12 mt-12 border-t border-gray-200">
                <p class="text-gray-600">&copy; 2024. All Rights Reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Terms & Conditions</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Privacy policy</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>