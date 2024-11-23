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
  <div class="header-section">
    <div class="header-overlay"></div>
    <div class="header-content">
      <p class="text-[#80BCBD] text-2xl font-light ml-56 ">/ BERSIHINAJA - CLEANING SERVICE</p>
      <h1 class="text-white text-7xl font-bold ml-56">Ruangan <br><span>Bersih Berkilau</span></h1>
    </div>
  </div>


  <div class="container py-5">
    <section id="about-us" class=" p-10 mt-20">
      <p class="text-[#80BCBD] text-2xl font-light ">/ ABOUT US</p>
      <div class="flex flex-row justify-between items-start">
        <div>
          <h2 class="text-5xl font-bold mb-4 text-start">
            Bersih Sempurna <br> Menuju Perfeksionis
          </h2>
        </div>
        <div>
          <p class="flex flex-row  text-end text-gray-600 mb-5">
            Kami menyediakan layanan kebersihan profesional yang dirancang untuk <br>
            memenuhi kebutuhan Anda dengan jadwal yang fleksibel dan perhatian <br>
            terhadap detail. Dengan tim terlatih dan berpengalaman
          </p>
        </div>
      </div>

      <div class="row text-center justify-content-center">
        <div class="col-md-4">
          <div class="service-card shadow-lg bg-[#80BCBD] py-4 rounded">
            <h3 class="text-4xl font-bold mb-2 text-white">50+</h3>
            <p class="text-white">Professional Teams</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-card shadow-lg bg-[#80BCBD] py-4 rounded">
            <h3 class="text-4xl font-bold mb-2 text-white">200+</h3>
            <p class="text-white">Tools Used</p>
          </div>
        </div>
      </div>
    </section>


    <section id="choose-us" class="bg-[#F9F9FE] h-full w-full p-10 rounded-3 mt-20">
      <p class="text-[#80BCBD] text-2xl font-light">/ WHY CHOOSE US</p>
      <div class="flex flex-row justify-between items-start">
        <h2 class="text-6xl font-bold mb-4 text-start">Pilih Bersih, <br> Pilih BersihinAja</h2>
        <div class="col-md-4 mr-5">
          <div class="service-card shadow-lg bg-[#80BCBD] py-4 rounded text-center">
            <h3 class="text-4xl font-bold mb-2 text-white">341+</h3>
            <p class="text-white">Projects Finished</p>
          </div>
        </div>
      </div>


      <div class="flex flex-row justify-between mt-6">
        <div class="flex flex-col gap-6 w-1/2 pr-4">
          <div class="d-flex flex-row align-items-center">
            <div class="flex justify-content-center align-items-center h-28 w-28 bg-[#AAD9BB] rounded-3 mr-3">
              <img src="/bersihinAja/user/assets/users.svg" alt="">
            </div>
            <div class="flex flex-col text-start">
              <h3 class="mt-2">Crew Handal</h3>
              <p>Tim kami terdiri dari crew yang handal, terlatih, <br>
                dan akan memberikan layanan terbaik.</p>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center">
            <div class="d-flex justify-content-center align-items-center h-28 w-28 bg-[#AAD9BB] rounded-3 mr-3">
              <img src="/bersihinAja/user/assets/clock.svg" alt="">
            </div>
            <div class="flex flex-col text-start">
              <h3 class="mt-2">Jadwal Fleksibel</h3>
              <p>Kami menawarkan jadwal layanan fleksibel yang <br>
                dapat disesuaikan dengan kebutuhan anda.</p>
            </div>
          </div>
        </div>

        <div class="flex flex-col gap-6 w-1/2 pl-4">

          <div class="d-flex flex-row align-items-center">
            <div class="d-flex justify-content-center align-items-center h-28 w-28 bg-[#AAD9BB] rounded-3 mr-3">
              <img src="/bersihinAja/user/assets/package.svg" alt="">
            </div>
            <div class="flex flex-col text-start">
              <h3 class="mt-2">Paket yang Fleksibel</h3>
              <p>Paket layanan kami fleksibel, dirancang <br>
                sesuai kebutuhan dan anggaran Anda.</p>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center">
            <div class="d-flex justify-content-center align-items-center h-28 w-28 bg-[#AAD9BB] rounded-3 mr-3">
              <img src="/bersihinAja/user/assets/smile.svg" alt="">
            </div>
            <div class="flex flex-col text-start">
              <h3 class="mt-2">Perhatian terhadap Detail</h3>
              <p>Kami selalu fokus pada detail untuk memastikan <br>
                hasil kebersihan yang sempurna.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container py-5">
        <p class="text-[#80BCBD] text-2xl font-light">/ OUR SERVICES</p>
        <div class="flex flex-row justify-between items-start mb-4">
          <h1 class="text-start font-bold text-6xl mb-2">Pilih Paket Mu!</h1>
          <button class="service-card bg-[#80BCBD] text-white py-2 px-4 rounded">Lihat Semua</button>
        </div>

        <div class="row g-4">
          <!-- Card 1 -->
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
            <div class="flex justify-content-end flex-col text-center">
              <img src="https://picsum.photos/200" alt="" class="w-full rounded-3 my-2">
              <div class="icon">
                <i class="bi bi-house"></i>
              </div>
              <h5>Home Cleaning</h5>
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
              <h5>Office Cleaning</h5>
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
              <h5>Kitchen Cleaning</h5>
              <p>Ensure a spotless and hygienic kitchen for your family.</p>
            </div>
          </div>

    </section>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>