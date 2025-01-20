<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CategoryModelimpl.php');
$contrl = new CategoryModelimpl();
$result2 = $contrl->getCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Category Management</title>
</head>

<body class="text-blue-900 font-inter">

    <!-- Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-blue-800 p-4 z-50 sidebar-menu transition-transform">
        <a href="#" class="flex items-center pb-4 border-b border-b-blue-700">
            <img src="../../../assets/images/LOGO.svg" alt="Youdemy Platform">
        </a>
        <ul class="mt-4">
            <li class="mb-1 group active">
                <a href="./dashbord.php" class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 rounded-md">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="./Category.php" class="flex items-center py-2 px-4 text-blue-100 hover:bg-blue-700 rounded-md">
                    <i class="ri-file-copy-2-fill mr-3 text-lg"></i>
                    <span class="text-sm">Categories</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-blue-50 min-h-screen">
        <div class="py-2 px-6 bg-blue-100 flex items-center shadow-md sticky top-0">
            <h1 class="text-lg font-bold">Category Management</h1>
        </div>
        <div class="p-10">
            <!-- Add Category Button -->
            <button data-modal-toggle="categoryModal" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                Add Category
            </button>

            <!-- Category Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <?php foreach ($result2 as $category): ?>
                <div class="bg-white rounded-md border p-6 shadow hover:shadow-lg">
                    <div class="flex justify-between">
                        <span class="text-blue-600 font-semibold"><?= $category->getnom() ?></span>
                        <form action="deleteCategory.php" method="POST">
                            <input type="hidden" name="category_id" value="<?= $category->getId() ?>">
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="ri-delete-bin-line"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="categoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
            <h2 class="text-lg font-semibold text-blue-700 mb-4">Add New Category</h2>
            <form action="addCategory.php" method="POST">
                <div class="mb-4">
                    <label for="categoryName" class="block text-sm font-medium text-blue-600">Category Name</label>
                    <input type="text" id="categoryName" name="categoryName" class="w-full px-4 py-2 border rounded" required>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" id="cancelModalBtn">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const modal = document.querySelector('#categoryModal');
        const openModalBtn = document.querySelector('[data-modal-toggle="categoryModal"]');
        const cancelModalBtn = document.querySelector('#cancelModalBtn');

        // Open modal
        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        // Close modal
        cancelModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
</body>

</html>
