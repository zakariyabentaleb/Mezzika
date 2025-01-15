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
            <a class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white">
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
            <a class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md">
                <i class="ri-bookmark-line mr-3 text-lg"></i>
                <span class="text-sm">Tags</span>
                <i class="ri-arrow-right-s-line ml-auto"></i>
            </a>
        </li>
        <li class="mb-1 group">
            <a class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 hover:text-white rounded-md">
                <i class="ri-wordpress-fill mr-3 text-lg"></i>
                <span class="text-sm">Wikis</span>
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
            <div class="bg-white rounded-md border border-blue-200 p-6 shadow-md">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold"><i class="ri-group-fill"></i></div>
                            <div class="p-1 rounded bg-blue-100 text-blue-600 text-[12px] font-semibold leading-none ml-2">Student</div>
                        </div>
                        <div class="text-sm font-medium text-blue-400">Student</div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-blue-200 p-6 shadow-md">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold"><i class="ri-group-fill"></i></div>
                            <div class="p-1 rounded bg-blue-100 text-blue-600 text-[12px] font-semibold leading-none ml-2">Teacher</div>
                        </div>
                        <div class="text-sm font-medium text-blue-400">Teacher</div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-blue-200 p-6 shadow-md">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold"><i class="ri-group-fill"></i></div>
                            <div class="p-1 rounded bg-blue-100 text-blue-600 text-[12px] font-semibold leading-none ml-2">Cours</div>
                        </div>
                        <div class="text-sm font-medium text-blue-400">Cours</div>
                    </div>
                </div>
            </div>
            <!-- Add similar adjustments for other sections -->
        </div>
    </div>
</main>
</body>

</html>
