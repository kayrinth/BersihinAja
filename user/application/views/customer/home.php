<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BersihinAja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    <?php if ($this->session->flashdata('pesan_sukses')): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= $this->session->flashdata('pesan_sukses'); ?>',
        confirmButtonColor: '#89c6b6'
      });
    <?php endif; ?>
  </script>

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


    <section id="choose-us" class="bg-[#F9F9FE] h-full w-full p-10 rounded-3 mt-20 p-10 mt-20">
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


    <section id="our-team" class="p-10 mt-20">
      <div class="container py-5 bg-[#F9F9FE] rounded-3">
        <div class="text-center mb-5">
          <p class="text-[#80BCBD] text-2xl font-light">/ OUR TEAM</p>
          <h1 class="font-bold text-6xl mb-2">Tim dari BersihinAja</h1>
        </div>

        <div class="flex justify-center row">
          <div class="service-card col-md-3 w-full h-full shadow-md rounded-3 mx-1 py-3">
            <div class="relative">
              <img src="https://img.freepik.com/free-photo/portrait-volunteer-who-organized-donations-charity_23-2149230567.jpg?t=st=1732351129~exp=1732354729~hmac=371ed7652a85fd14f01f5f66bbf2cc121b70ef84f71e2dfd48e8287bc546332e&w=360"
                alt="Home Cleaning" class="w-full h-full object-cover rounded-3">
              <h5 class="absolute bottom-0 left-1/2 transform -translate-x-1/2 mb-4 bg-white text-black text-sm font-bold px-4 py-2 rounded">
                Susi Puji
              </h5>
            </div>
          </div>
          <div class="service-card col-md-3 w-full h-full shadow-md rounded-3 mx-1 py-3">
            <div class="relative">
              <img src="https://img.freepik.com/free-photo/portrait-volunteer-who-organized-donations-charity_23-2149230567.jpg?t=st=1732351129~exp=1732354729~hmac=371ed7652a85fd14f01f5f66bbf2cc121b70ef84f71e2dfd48e8287bc546332e&w=360"
                alt="Home Cleaning" class="w-full h-full object-cover rounded-3">
              <h5 class="absolute bottom-0 left-1/2 transform -translate-x-1/2 mb-4 bg-white text-black text-sm font-bold px-4 py-2 rounded">
                Susi Puji
              </h5>
            </div>
          </div>
          <div class="service-card col-md-3 w-full h-full shadow-md rounded-3 mx-1 py-3">
            <div class="relative">
              <img src="https://img.freepik.com/free-photo/portrait-volunteer-who-organized-donations-charity_23-2149230567.jpg?t=st=1732351129~exp=1732354729~hmac=371ed7652a85fd14f01f5f66bbf2cc121b70ef84f71e2dfd48e8287bc546332e&w=360"
                alt="Home Cleaning" class="w-full h-full object-cover rounded-3">
              <h5 class="absolute bottom-0 left-1/2 transform -translate-x-1/2 mb-4 bg-white text-black text-sm font-bold px-4 py-2 rounded">
                Susi Puji
              </h5>
            </div>
          </div>
        </div>
        <div class="bg-[#80BCBD] h-full w-full p-10 rounded-3 flex flex-col align-items-center mt-3 ">
          <h3 class="text-white font-bold text-3xl mb-6">Bergabunglah dengan Tim Impian Kebersihan Kami!</h3>
          <a class=" service-card btn btn-light rounded-3" href="<?php echo base_url('praregist') ?>">Bergabunglah Dengan Kami!</a>
        </div>
      </div>

    </section>

    <section id="testimonials" class="p-10 mt-0">
      <div class="container py-5">
        <div class="text-start mb-5">
          <p class="text-[#80BCBD] text-2xl font-light">/ TESTIMONIALS</p>
          <h1 class="font-bold text-6xl mb-2 text-start">Hasil Review<br>Customer Kami</h1>
        </div>
        <div class="flex flex-row">
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
            <h5 class="mx-3 mt-3">Joni</h5>
            <p class="mx-3">Home Cleaning</p>
            <p class="mx-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis eaque dicta deleniti tempora doloribus?.</p>
          </div>
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
            <h5 class="mx-3 mt-3">Joni</h5>
            <p class="mx-3">Home Cleaning</p>
            <p class="mx-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis eaque dicta deleniti tempora doloribus?.</p>
          </div>
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
            <h5 class="mx-3 mt-3">Joni</h5>
            <p class="mx-3">Home Cleaning</p>
            <p class="mx-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis eaque dicta deleniti tempora doloribus?.</p>
          </div>
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
            <h5 class="mx-3 mt-3">Joni</h5>
            <p class="mx-3">Home Cleaning</p>
            <p class="mx-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis eaque dicta deleniti tempora doloribus?.</p>
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