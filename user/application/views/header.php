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

        <!-- Hamburger Menu Button (Mobile) -->
        <div class="sm:hidden">
          <button id="menu-btn" class="text-gray-800 focus:outline-none">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>

        <!-- Navigation Links -->
        <div id="menu-links" class="hidden sm:flex space-x-8">
          <a href="#" class="text-black text-sm font-medium">Home</a>
          <a href="#about-us" class="text-black text-sm font-medium">About Us</a>
          <a href="#choose-us" class="text-black text-sm font-medium">Why Us</a>
          <a href="#services" class="text-black text-sm font-medium">Services</a>
          <a href="#our-team" class="text-black text-sm font-medium">Our Team</a>
          <a href="#testimonials" class="text-black text-sm font-medium">Review</a>
        </div>

        <!-- Login Button -->
        <div class="hidden sm:block">
          <a href="/BersihinAja/user/" class="bg-[#80BCBD] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-teal-500 transition duration-200">
            Log in
          </a>
        </div>
      </div>

      <!-- Mobile Menu Links -->
      <div id="mobile-menu" class="hidden flex-col space-y-4 sm:hidden mt-4 text-center">
        <a href="#" class="text-black text-sm font-medium">Home</a>
        <a href="#about-us" class="text-black text-sm font-medium">About Us</a>
        <a href="#choose-us" class="text-black text-sm font-medium">Why Us</a>
        <a href="#services" class="text-black text-sm font-medium">Services</a>
        <a href="#our-team" class="text-black text-sm font-medium">Our Team</a>
        <a href="#testimonials" class="text-black text-sm font-medium">Review</a>
        <a href="/BersihinAja/user/" class="bg-[#80BCBD] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-teal-500 transition duration-200 block">
          Log in
        </a>
      </div>
    </div>
  </nav>

  <script>
    // Toggle Menu Button
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>

</html>