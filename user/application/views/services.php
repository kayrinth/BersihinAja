<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BersihinAja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    .header-section {
      position: relative;
      background-image: url('/bersihinAja/user/assets/6856377.png');
      background-size: cover;
      background-position: center;
      height: 40vh;
      display: flex;
      align-items: center;
    }

    .header-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }

    .service-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .header-content {
      position: relative;
      z-index: 2;
    }
  </style>
</head>

<body>
  <!-- Header Section -->
    <div class="header-section relative flex items-center justify-center h-screen bg-gray-800">
        <div class="header-overlay absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="header-content relative z-10 text-center">
            <h1 class="text-white text-5xl font-bold">Harga Paket BersihinAja</h1>
        </div>
    </div>
  <!-- Services Section -->
    <section id="services" class="p-10">
      <div class="container py-5">
        <p class="text-[#80BCBD] text-2xl font-light">/ OUR SERVICES</p>
        <div class="flex flex-row justify-between items-start mb-4">
          <h1 class="text-start font-bold text-6xl mb-2">Pilih Paket Mu!</h1>
        </div>

        <div class="flex flex-row">
          <!-- Card 1 -->
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
            <div class="flex justify-content-end flex-col text-center">
              <img src="https://picsum.photos/200" alt="" class="w-full rounded-3 my-2">
              <div class="icon">
                <i class="bi bi-house"></i>
              </div>
              <h5>Small</h5>
              <p>Get your home cleaned by our professional cleaning team.</p>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3  mx-1">
            <div class="flex justify-content-end flex-col text-center">
              <img src="https://picsum.photos/200" alt="" class="w-full rounded-3 my-2">
              <div class="icon">
                <i class="bi bi-building"></i>
              </div>
              <h5>Medium</h5>
              <p>Maintain your office environment clean and professional.</p>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3  mx-1">
            <div class="flex justify-content-end flex-col text-center">
              <img src="https://picsum.photos/200" alt="" class="w-full rounded-3 my-2">
              <div class="icon">
                <i class="bi bi-cup-straw"></i>
              </div>
              <h5>Large</h5>
              <p>Ensure a spotless and hygienic kitchen for your family.</p>
            </div>
          </div>
        <!-- Card 4 -->
        <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3  mx-1">
            <div class="flex justify-content-end flex-col text-center">
              <img src="https://picsum.photos/200" alt="" class="w-full rounded-3 my-2">
              <div class="icon">
                <i class="bi bi-cup-straw"></i>
              </div>
              <h5>XLarge</h5>
              <p>Ensure a spotless and hygienic kitchen for your family.</p>
            </div>
        </div>
    </section>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>