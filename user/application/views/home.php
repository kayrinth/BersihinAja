<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BersihinAja</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .header-section {
      position: relative;
      background-image: url('/bersihinAja/user/assets/6856377.png'); 
      background-size: cover;
      background-position: center;
      height: 100vh;
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

    .header-content {
      position: relative;
      z-index: 2;
    }

  </style>
</head>
<body>
  <!-- Header Section -->
  <div class="header-section">
    <div class="header-overlay"></div>
    <div class="header-content">
      <p class="text-[#80BCBD] text-2xl font-light ml-56 ">/BERSIHINAJA - CLEANING SERVICE</p>
      <h1 class="text-white text-7xl font-bold ml-56">Ruangan <br><span>Bersih Berkilau</span></h1>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container py-5">
    <!-- About Section -->
    <section class="mb-5">
      <h2 class="text-3xl font-bold mb-4 text-center">Bersih Sempurna Menuju Perfeksionis</h2>
      <p class="text-center text-gray-600 mb-5">
        Kami menyediakan layanan kebersihan profesional dengan jadwal fleksibel dan perhatian terhadap detail.
      </p>
      <div class="row text-center justify-content-center">
        <div class="col-md-4">
          <div class="bg-success bg-opacity-10 py-4 rounded">
            <h3 class="text-4xl font-bold mb-2">50+</h3>
            <p>Professional Teams</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="bg-success bg-opacity-10 py-4 rounded">
            <h3 class="text-4xl font-bold mb-2">200+</h3>
            <p>Tools Used</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="mb-5">
      <h2 class="text-3xl font-bold mb-4 text-center">Pilih Bersih, Pilih BersihinAja</h2>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="bg-success bg-opacity-10 py-4 rounded text-center">
            <h3 class="text-4xl font-bold mb-2">341+</h3>
            <p>Projects Finished</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-6 text-center">
              <div class="d-flex flex-column align-items-center">
                <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-check-circle fs-3 text-success"></i>
                </div>
                <p class="mt-2">Crew Andal</p>
              </div>
            </div>
            <div class="col-6 text-center">
              <div class="d-flex flex-column align-items-center">
                <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-clock fs-3 text-success"></i>
                </div>
                <p class="mt-2">On-Time Services</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
