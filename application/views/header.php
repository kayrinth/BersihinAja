<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Header</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <a href="<?php echo base_url('/'); ?>" class="flex items-center">
            <img src="/assets/wind.svg" alt="logo" class="h-6 mr-2">
            <span class="text-xl font-bold text-gray-800">BersihinAja</span>
          </a>
        </div>

        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center space-x-6">
          <a href="<?php echo base_url('/'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Home</a>
          <a href="<?php echo base_url('services'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Services</a>
          <a href="<?php echo base_url('praregist'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Our Team</a>
          <a href="<?php echo base_url('review'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Review</a>
        </div>

        <!-- Login / Dropdown -->
        <div class="hidden md:flex items-center relative">
          <?php if ($this->session->userdata('id_user')) : ?>
            <button id="dropdown-btn" type="button" class="flex items-center text-sm font-medium text-gray-800 focus:outline-none">
              <?= $this->session->userdata('Nama_User'); ?>
              <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div id="dropdown-menu"
              class="hidden absolute top-full right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50">
              <a href="<?= base_url('auth/updateUser') ?>" class="block px-4 py-2 text-sm hover:bg-gray-100">Edit Profile</a>
              <a href="<?= base_url('history') ?>" class="block px-4 py-2 text-sm hover:bg-gray-100">History</a>
              <a href="<?= base_url('auth/logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</a>
            </div>
          <?php else : ?>
            <a href="<?= base_url('auth') ?>" class="ml-4 bg-[#80BCBD] text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-500 transition">Login</a>
          <?php endif; ?>
        </div>

        <!-- Mobile Button -->
        <div class="md:hidden flex items-center">
          <button id="menu-btn" class="text-gray-800 focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden bg-white border-t my-6 py-4 px-4 rounded shadow-md">
        <div class="flex flex-col space-y-3">
          <a href="<?php echo base_url('/'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Home</a>
          <a href="<?php echo base_url('services'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Services</a>
          <a href="<?php echo base_url('praregist'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Our Team</a>
          <a href="<?php echo base_url('review'); ?>" class="text-sm font-medium text-gray-800 hover:text-[#80BCBD]">Review</a>

          <?php if ($this->session->userdata('id_user')) : ?>
            <hr>
            <a href="<?= base_url('auth/updateUser') ?>" class="text-sm font-medium text-gray-800">Edit Profile</a>
            <a href="<?= base_url('history') ?>" class="text-sm font-medium text-gray-800">History</a>
            <a href="<?= base_url('auth/logout') ?>" class="text-sm font-medium text-red-600">Logout</a>
          <?php else : ?>
            <a href="<?= base_url('auth') ?>" class="bg-[#80BCBD] text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-500 transition text-center">
              Login
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <script>
    const dropdownBtn = document.getElementById('dropdown-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (dropdownBtn) {
      dropdownBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
      });

      document.addEventListener('click', (event) => {
        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });
    }

    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>

  <!-- <script>
    const dropdownBtn = document.getElementById('dropdown-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');

    dropdownBtn.addEventListener('click', () => {
      dropdownMenu.classList.toggle('hidden');
    });

    // Klik di luar untuk menutup dropdown
    document.addEventListener('click', (event) => {
      if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });


    // Toggle Mobile Menu
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script> -->
</body>

</html>