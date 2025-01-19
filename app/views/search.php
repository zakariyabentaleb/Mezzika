
<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CourModelimpl.php');

session_start();
$search=new CourModelimpl();
$query=$_GET['query'] ;
$searchResults= $search->searchCour($query);
var_dump($searchResults);

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
            background: linear-gradient(to right, #f2b212, #fadf10);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>
    <!-- Main container -->
    <div class=" flex flex-col">
        <!-- Top bar -->
        <div class="hidden md:block w-full bg-blue-600 text-white">
            <div class="container mx-auto px-4 py-2">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-6">
                        <span><i class="ri-phone-line mr-2"></i> +212 772508881</span>
                        <span><i class="ri-mail-line mr-2"></i> contact@youdemy.com</span>
                    </div>
                    <span><i class="ri-map-pin-line mr-2"></i> Massira N641 Safi, Morocco</span>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="border-b bg-white">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-4">
                    <a href="../index.php">
                        <img src="../assets/images/Youdemy_Logo.svg" alt="Youdemy Platform">
                    </a>
                    <nav class="hidden md:flex items-center space-x-6">
                        <?php  ?>
                            <a href="" class="text-gray-900 hover:text-blue-500 transition-colors">
                               
                            </a>
                        <?php  ?>
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
            </div>
        </header>

        <!-- Hero Section -->
                <!-- Hero Section -->
                <section
            class="hero bg-bg-blue-500/5 flex-grow flex items-center bg-opacity-20 bg-[url('../assets/images/hero-bg1.png')]  bg-cover bg-center">
            <div class="container mx-auto flex flex-col items-center py-12 px-6 md:px-12">
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-4xl font-bold">
                    Find Your Course
                    </h1>
                </div>
                <!-- Search Form -->
                <div class="mt-8 w-[40%]">
                        <form action="./search.php" method="GET" class="relative">
                            <input type="text" name="query" placeholder="What Do You Need To Learn?"
                                class="w-full p-3 pl-4 rounded-full border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <button type="submit"
                                class="bg-blue-400 absolute right-1 top-1 bottom-1 px-4 text-white rounded-full hover:bg-blue-500">
                                Search
                            </button>
                        </form>
                    </div>
            </div>
        </section>

        <!-- Courses Grid Section -->
        <section class="py-10">
            <div class="container mx-auto px-6">
                <h2 class="text-2xl text-center text-gray-800 mb-10">Search result for : <span class="text-gradient"><?= htmlspecialchars( $_GET['query']); ?></span></h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (!empty($searchResults)): ?>
                        <?php foreach ($searchResults as $result): ?>
                            <div
                            class="bg-white border border-blue-400 rounded-lg shadow-md p-4 hover:scale-105 transition-transform">
                            <img src="../uploads/thumbnails/" alt="Course Image"
                                class="rounded-t-lg w-full">
                            <div class="py-3">
                                <p class="text-sm text-gray-500 flex items-center space-x-2"> <span
                                        class="font-bold ml-1"></span>
                                </p>
                                <h3 class="text-lg font-semibold text-gray-800 mt-2"><?= $result->gettitre() ?>
                                </h3>
                                <p class="text-gray-600 text-sm mt-1"><?= $result->getdescription() ?></p>
                                <div class="flex items-center justify-between mt-3">
                                    <p class="text-blue-400 font-bold"> $</p>
                                    <button class="font-bold underline text-blue-400"><a
                                            href="./previewcour.php?id=<?php echo $result->getId() ?>">View
                                            Course</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500">No courses available</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</body>

</html>