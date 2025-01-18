<?php
session_start();
require_once('../controller/impl/Courcontrollerimpl.php');
$contrl = new Courcontrollerimpl();
$id = $_GET["id"];
$result = $contrl->getCourseById($id);
$result2 = $contrl->getCourseTeacher($id);
// var_dump($result);
// var_dump($result2);
$result3 = $contrl->getCoursetags($id);
// var_dump($result3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.svg">
    <script src="./assets/scripts/main.js" defer></script>
    <style>
        .text-gradient {
            background: linear-gradient(to right, rgb(70, 18, 242), rgb(51, 16, 250));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>

    <!-- main container -->
    <div class=" flex flex-col">
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
                    <a href="./index.php">
                        <img src="../../assets/images/LOGO.svg" alt="Youdemy Platform">
                    </a>
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="../../index.php"
                            class="text-gray-900   hover:text-bg-blue-600 transition-colors">Home</a>
                        <a href="/app/views/cours.php"
                            class="text-blue-600 font-bold hover:text-bg-blue-600 transition-colors">Courses</a>
                        <a href="./pages/pricing.php"
                            class="text-gray-900 hover:text-bg-blue-600 transition-colors">Pricing</a>
                        <a href="./pages/features.php"
                            class="text-gray-900 hover:text-bg-blue-600 transition-colors">Features</a>
                        <a href="./pages/features.php"
                            class="text-gray-900 hover:text-bg-blue-600 transition-colors">Blog</a>
                        <?php
                        if (!isset($_SESSION["user"])) {
                            ?>
                            <a href="./pages/contact.php" class="text-gray-900 hover:text-bg-blue-600 transition-colors">My
                                Courses</a>
                            <?php
                        } else {
                            ?>
                            <a href="./pages/contact.php"
                                class="text-gray-900 hover:text-bg-blue-600 transition-colors">Help Center</a>
                            <?php
                        }
                        ?>
                    </nav>
                    <?php
                    if (!isset($_SESSION["user"])) {
                        ?>
                        <div class="flex items-center space-x-4">
                            <button
                                class="p-2 px-4 bg-blue-600 text-white rounded-full hover:bg-white hover:text-blue-600 hover:border hover:border-blue-600 transition-colors">
                                <a href="../app/user/login.php">Login</a>
                            </button>

                            <button
                                class="p-2 px-4 border border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition-colors">
                                <a href="../app/user/register.php">Register</a>
                            </button>


                            <button class="p-2 hover:text-bg-blue-600 transition-colors">
                                <i class="ri-menu-4-fill text-2xl"></i>
                            </button>
                        </div>
                        <?php
                    } else {

                        ?>

                        <div class="flex items-center space-x-4">
                            <form action="\app\controller\base\baseController.php" method="POST">
                                <button type="submit" name="logout"
                                    class="p-2 px-4 bg-blue-600 text-white rounded-full hover:bg-white hover:text-blue-600 hover:border hover:border-blue-600 transition-colors">
                                    Log out
                                </button>
                                <button
                                    class="p-2 px-4 border border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition-colors">
                                    <a href="../app/user/register.php"><?php echo $_SESSION['user']['nom'] ?></a>
                                </button>
                            </form>

                            <button class="p-2 hover:text-bg-blue-600 transition-colors">
                                <i class="ri-menu-4-fill text-2xl"></i>
                            </button>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
            </div>

            <!-- Mobile Menu-->
            <div id="mobile-menu" class="hidden md:hidden py-4">
                <nav class="flex flex-col space-y-4">
                    <a href="../index.php"
                        class="text-blue-600 font-bold  hover:text-bg-blue-600 transition-colors">Home</a>
                    <a href="./pages/courses.php"
                        class="text-gray-900 hover:text-bg-blue-600 transition-colors">Courses</a>
                    <a href="./pages/pricing.php"
                        class="text-gray-900 hover:text-bg-blue-600 transition-colors">Pricing</a>
                    <a href="./pages/features.php"
                        class="text-gray-900 hover:text-bg-blue-600 transition-colors">Features</a>
                    <a href="./pages/features.php"
                        class="text-gray-900 hover:text-bg-blue-600 transition-colors">Blog</a>
                    <a href="./pages/contact.php" class="text-gray-900 hover:text-bg-blue-600 transition-colors">Help
                        Center</a>
                </nav>
            </div>
    </div>
    </header>
    <div class="sm:px-6 lg:px-8 py-4">
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <a href="../index.php" class="hover:text-gray-700">Home</a>
            <i class="ri-arrow-right-s-line"></i>
            <a href="../pages/mycourses.php" class="hover:text-gray-700">Courses</a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="text-gray-700"> </span>
        </div>
    </div>

    <!-- Hero Section -->
    </div>
    <!-- Courses Grid Section -->

    <?php
    foreach ($result as $cour) {
        ?>
        <div class="sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
                <div class="flex">
                    <div class="rounded-lg overflow-hidden flex-grow">
                        <img src="/assets/images/cover4.png" alt="" class="rounded-lg h-full object-cover w-full">
                    </div>
                </div>

                <div class="flex flex-col justify-between ">
                    <div>
                        <h1 class="text-3xl font-bold mb-6"><?= $cour->titre ?></h1>
                        <div class="text-4xl font-bold mb-8 text-blue-400">
                            <?= $cour->price ?><span class="text-sm font-normal">USD</span>
                        </div>

                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center justify-between py-2 border-b">
                            <div class="flex items-center gap-2">
                                <i class="ri-layout-grid-line"></i>
                                <span>Category</span>
                            </div>
                            <span></span>
                        </div>

                        <div class="flex items-center justify-between py-2 border-b">
                            <div class="flex items-center gap-2">
                                <i class="ri-signal-tower-line"></i>
                                <span>Difficulty :</span>
                                <p><?= $cour->Difficulty ?></p>
                            </div>
                            <span></span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b">
                            <div class="flex items-center gap-2">
                                <i class="ri-user-line"></i>
                                <span>Students</span>
                            </div>
                            <span></span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b">
                            <div class="flex items-center gap-2">
                                <i class="ri-time-line"></i>
                                <span>Duration :</span>
                                <p><?= $cour->Duration ?></p>
                            </div>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button
                        class="md:mt-6 flex-1 bg-blue-400 text-white py-3 font-bold text-lg rounded-lg hover:bg-gray-800">
                        <a href="enroll.php?courseId=<?= urlencode($courseId) ?>">Enroll Now</a>
                    </button>
                </div>
            </div>
        </div>
        </div>
        <div class="sm:px-6 lg:px-8 py-4 mt-12">
            <div class="bg-red-600 shadow-sm border rounded-lg bg-white p-4 py-6 pl-8">
                <h2 class="text-2xl font-bold mb-4 text-blue-400">Course Description</h2>
                <div class="prose max-w-none">
                    <p class="text-gray-600 leading-relaxed">
                        <?= $cour->description ?>
                    </p>
                </div>
            </div>
            <?php
            foreach ($result2 as $res) {

                ?>
                <div class="border rounded-lg bg-white p-4 py-6 mt-12 pl-8">
                    <div class="flex justify-between items-center space-x-4">
                        <div class="w-[15%]">
                            <img src="../../assets/images/Anonymous-Profile-pic.jpg "
                                class="rounded-full w-32 h-32 object-cover">
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-black">
                                <?php ?>
                            </h3>
                            <p class="text-gray-500 mt-2">
                                <?php ?>
                            </p>
                            <div class="flex items-center space-x-4 mt-2 text-gray-600">
                                <div class="flex items-center">
                                    <i class="ri-user-3-line mr-1 text-blue-400"></i>
                                    <span> Students</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="ri-video-line mr-1 text-blue-400"></i>
                                    <span> Courses</span>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-4 leading-relaxed">
                            <p><?= $res->teacher ?></p>
                            <?php
                            echo
                                'A passionate educator dedicated to helping learners achieve their goals through engaging and insightful courses. With expertise in various fields, our instructors bring a wealth of knowledge and experience to empower students worldwide.'

                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>


        </div>
        <?php
    }
    ?>

    <!-- Footer Section -->

    <footer class="bg-blue-10 py-16 ">
        <div class="px-10">
            <div class="mb-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center hover:bg-transparent hover:border hover:border-blue-600 hover:scale-95 transition-transform duration-300">
                        <i class="ri-team-line text-2xl text-blue-600 mb-2"></i>
                        <p class="font-medium">Community</p>
                    </div>
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center hover:bg-transparent hover:border hover:border-blue-600 hover:scale-95 transition-transform duration-300">
                        <i class="ri-link text-2xl text-blue-600 mb-2"></i>
                        <p class="font-medium">Referrals</p>
                    </div>
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center hover:bg-transparent hover:border hover:border-blue-600 hover:scale-95 transition-transform duration-300">
                        <i class="ri-book-2-line text-2xl text-blue-600 mb-2"></i>
                        <p class="font-medium">Assignments</p>
                    </div>
                    <div
                        class="bg-blue-50 p-6 rounded-lg text-center  hover:bg-transparent hover:border hover:border-blue-600 hover:scale-95 transition-transform duration-300">
                        <i class="ri-medal-line text-2xl text-blue-600 mb-2"></i>
                        <p class="font-medium">Certificates</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <img src="../../assets/images/LOGO.svg" height="200" width="200">
                    </div>
                    <p class="text-gray-600 mb-6">Eros in cursus turpis massa tincidunt Faucibus scelerisque eleifend
                        vulputate sapien nec sagittis.</p>
                    <div class="flex gap-4">
                        <div
                            class="h-9 w-9 bg-blue-600 flex justify-center items-center rounded-lg hover:border hover:border-blue-600 hover:bg-transparent hover:text-blue-600">
                            <a href="#" class="p-2 transition-colors">
                                <i class="ri-facebook-fill text-xl "></i>
                            </a>
                        </div>

                        <div
                            class="h-9 w-9 bg-blue-600 flex justify-center items-center rounded-lg hover:border hover:border-blue-600 hover:bg-transparent hover:text-blue-600">
                            <a href="#" class="p-2 transition-colors">
                                <i class="ri-instagram-line text-xl "></i>
                            </a>
                        </div>

                        <div
                            class="h-9 w-9 bg-blue-600 flex justify-center items-center rounded-lg hover:border hover:border-blue-600 hover:bg-transparent hover:text-blue-600">
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
                            class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-blue-600">
                        <button
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-600 transition-colors">Submit</button>
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