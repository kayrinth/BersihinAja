<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Header</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <nav class="bg-white shadow">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
          <span class="text-2xl font-bold text-gray-800 flex items-center">
            <img src="/bersihinAja/user/assets/wind.svg" alt="logo" class="h-6 mr-2">
            BersihinAja
          </span>
        </div>

        <!-- Navigation Links -->
        <div class="hidden sm:flex items-center space-x-8">
          <a href="<?php echo base_url('home'); ?>" class="text-black text-sm font-medium">Home</a>
          <a href="<?php echo base_url('services'); ?>" class="text-black text-sm font-medium">Services</a>
          <a href="<?php echo base_url('review'); ?>" class="text-black text-sm font-medium">Review</a>

          <!-- Nama User dan Tombol -->
          <?php if ($this->session->userdata('id_customer')) : ?>
            <span class="text-black text-sm font-medium">
              <?php echo $this->session->userdata('username'); ?>
            </span>
            <a href="<?php echo base_url('auth/logout'); ?>" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-600 transition duration-200">
              Logout
            </a>
          <?php else : ?>
            <a href="<?php echo base_url('auth'); ?>" class="bg-[#80BCBD] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-teal-500 transition duration-200">
              Login
            </a>
          <?php endif; ?>
        </div>

        <!-- Mobile Hamburger Menu -->
        <div class="sm:hidden">
          <button id="menu-btn" class="text-gray-800 focus:outline-none">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu Links -->
      <div id="mobile-menu" class="hidden flex-col space-y-4 sm:hidden mt-4 text-center">
        <a href="<?php echo base_url('home'); ?>" class="text-black text-sm font-medium">Home</a>
        <a href="<?php echo base_url('services'); ?>" class="text-black text-sm font-medium">Services</a>
        <a href="<?php echo base_url('review'); ?>" class="text-black text-sm font-medium">Review</a>

        <?php if ($this->session->userdata('id_customer')) : ?>
          <span class="text-black text-sm font-medium">
            <?php echo $this->session->userdata('username'); ?>
          </span>
          <a href="<?php echo base_url('auth/logout'); ?>" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-600 transition duration-200">
            Logout
          </a>
        <?php else : ?>
          <a href="<?php echo base_url('auth'); ?>" class="bg-[#80BCBD] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-teal-500 transition duration-200">
            Login
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <script>
    // Toggle Mobile Menu
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>

</html>