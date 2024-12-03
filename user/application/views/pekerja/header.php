<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Ensure content doesn't get hidden behind sidebar on larger screens */
        @media (min-width: 640px) {
            #main-content {
                margin-left: 16rem;
                /* 64 * 0.25rem = 16rem, matching sidebar width */
                width: calc(100% - 16rem);
                max-width: 1200px;
            }
        }

        #main-content {
            padding: 1rem;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-white w-64 h-full shadow-lg fixed z-30 transform -translate-x-full sm:translate-x-0 transition-transform duration-300">
            <div class="p-4 flex items-center">
                <img src="/bersihinAja/user/assets/wind.svg" alt="logo" class="h-6 mr-2">
                <span class="text-2xl font-bold text-gray-800">BersihinAja</span>
            </div>
            <nav class="mt-6">
                <a href="<?php echo base_url('pekerja/beranda'); ?>" class="block py-2.5 px-4 text-gray-700 rounded hover:bg-gray-200">Home</a>
                <a href="<?php echo base_url('pekerja/transaksi'); ?>" class="block py-2.5 px-4 text-gray-700 rounded hover:bg-gray-200">Transaksi</a>
                <a href="<?php echo base_url('pekerja/customer'); ?>" class="block py-2.5 px-4 text-gray-700 rounded hover:bg-gray-200">Customer</a>
                <a href="<?php echo base_url('pekerja/review'); ?>" class="block py-2.5 px-4 text-gray-700 rounded hover:bg-gray-200">Review</a>
            </nav>
            <div class="mt-6 px-4">
                <?php if ($this->session->userdata('id_user')) : ?>
                    <button type="button" onclick="window.location.href='<?= base_url('auth/updateUser') ?>'" class="block w-full text-left py-2.5 px-4 bg-gray-200 rounded text-gray-700">
                        <?= $this->session->userdata('Nama_User'); ?>
                    </button>
                    <a href="<?php echo base_url('auth/logout'); ?>" class="block py-2.5 px-4 bg-red-500 text-white rounded hover:bg-red-600 mt-2">Logout</a>
                <?php else : ?>
                    <a href="<?php echo base_url('auth'); ?>" class="block py-2.5 px-4 bg-[#80BCBD] text-white rounded hover:bg-teal-500">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <main>
        <div class="container pt-4">
            <!-- Section: Dynamic Content -->

            <!-- Section: Dynamic Content -->
        </div>
    </main>

    <script>
        // Toggle Sidebar for Mobile
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

</body>

</html>