<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Custom Header</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <nav class="bg-white shadow">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
          <span class="text-2xl font-bold text-gray-800 flex items-center">
            <img src="/bersihinAja/user/assets/wind.svg" alt="logo">
            BersihinAja
          </span>
        </div>

        <!-- Navigation Links -->
        <div class="hidden sm:flex space-x-8">
          <a href="#" class="text-black text-sm font-medium">Home</a>
          <a href="#about-us" class="text-black text-sm font-medium">About Us</a>
          <a href="#choose-us" class="text-black text-sm font-medium">Services</a>
          <a href="#" class="text-black text-sm font-medium">Review</a>
          <a href="#" class="text-black text-sm font-medium">Contact Us</a>
        </div>

        <!-- Login Button -->
        <div>
          <a href="/BersihinAja/user/" class="bg-[#80BCBD] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-teal-500 transition duration-200">
            Log in
          </a>
        </div>
      </div>
    </div>
  </nav>
</body>

</html>