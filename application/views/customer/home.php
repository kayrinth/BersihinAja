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
      background-image: url('/bersihinAja/assets/6856377.png');
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
    <div class="header-content text-center md:text-left px-4 md:ml-56">
      <p class="text-[#80BCBD] text-xl md:text-2xl font-light">/ BERSIHINAJA - CLEANING SERVICE</p>
      <h1 class="text-white text-4xl md:text-7xl font-bold">Ruangan <br><span>Bersih Berkilau</span></h1>
    </div>
  </div>

  <div class="container py-5">
    <section id="about-us" class="p-4 md:p-10 mt-10 md:mt-20">
      <p class="text-[#80BCBD] text-xl md:text-2xl font-light">/ ABOUT US</p>
      <div class="flex flex-col md:flex-row justify-between gap-6">
        <div>
          <h2 class="text-3xl md:text-5xl font-bold mb-4">Bersih Sempurna <br> Menuju Perfeksionis</h2>
        </div>
        <div>
          <p class="text-gray-600 text-sm md:text-base">
            Kami menyediakan layanan kebersihan profesional yang dirancang untuk
            memenuhi kebutuhan Anda dengan jadwal yang fleksibel dan perhatian
            terhadap detail. Dengan tim terlatih dan berpengalaman.
          </p>
        </div>
      </div>

      <div class="flex flex-col md:flex-row gap-4 text-center mt-6">
        <div class="service-card shadow-lg bg-[#80BCBD] py-4 rounded w-full md:w-1/2">
          <h3 class="text-3xl md:text-4xl font-bold mb-2 text-white">50+</h3>
          <p class="text-white">Professional Teams</p>
        </div>
        <div class="service-card shadow-lg bg-[#80BCBD] py-4 rounded w-full md:w-1/2">
          <h3 class="text-3xl md:text-4xl font-bold mb-2 text-white">200+</h3>
          <p class="text-white">Tools Used</p>
        </div>
      </div>
    </section>

    <section id="choose-us" class="bg-[#F9F9FE] w-full p-4 md:p-10 rounded-3 mt-10 md:mt-20">
      <p class="text-[#80BCBD] text-xl md:text-2xl font-light">/ WHY CHOOSE US</p>
      <div class="flex flex-col md:flex-row justify-between items-start gap-6">
        <h2 class="text-4xl md:text-6xl font-bold mb-4">Pilih Bersih, <br> Pilih BersihinAja</h2>
        <div class="service-card shadow-lg bg-[#80BCBD] py-4 rounded text-center w-full md:w-1/3">
          <h3 class="text-3xl md:text-4xl font-bold mb-2 text-white">341+</h3>
          <p class="text-white">Projects Finished</p>
        </div>
      </div>

      <div class="flex flex-col md:flex-row gap-6 mt-6">
        <div class="flex flex-col gap-6 w-full md:w-1/2">
          <!-- Crew Handal -->
          <div class="flex gap-3">
            <div class="flex justify-center items-center h-20 w-20 bg-[#AAD9BB] rounded-3">
              <img src="/bersihinAja/assets/users.svg" alt="">
            </div>
            <div>
              <h3 class="font-semibold">Crew Handal</h3>
              <p class="text-sm">Tim kami terdiri dari crew yang handal, terlatih, dan akan memberikan layanan terbaik.</p>
            </div>
          </div>
          <!-- Jadwal Fleksibel -->
          <div class="flex gap-3">
            <div class="flex justify-center items-center h-20 w-20 bg-[#AAD9BB] rounded-3">
              <img src="/bersihinAja/assets/clock.svg" alt="">
            </div>
            <div>
              <h3 class="font-semibold">Jadwal Fleksibel</h3>
              <p class="text-sm">Kami menawarkan jadwal layanan fleksibel yang dapat disesuaikan dengan kebutuhan Anda.</p>
            </div>
          </div>
        </div>

        <div class="flex flex-col gap-6 w-full md:w-1/2">
          <!-- Paket Fleksibel -->
          <div class="flex gap-3">
            <div class="flex justify-center items-center h-20 w-20 bg-[#AAD9BB] rounded-3">
              <img src="/bersihinAja/assets/package.svg" alt="">
            </div>
            <div>
              <h3 class="font-semibold">Paket yang Fleksibel</h3>
              <p class="text-sm">Paket layanan kami fleksibel, dirancang sesuai kebutuhan dan anggaran Anda.</p>
            </div>
          </div>
          <!-- Perhatian Detail -->
          <div class="flex gap-3">
            <div class="flex justify-center items-center h-20 w-20 bg-[#AAD9BB] rounded-3">
              <img src="/bersihinAja/assets/smile.svg" alt="">
            </div>
            <div>
              <h3 class="font-semibold">Perhatian terhadap Detail</h3>
              <p class="text-sm">Kami selalu fokus pada detail untuk memastikan hasil kebersihan yang sempurna.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="our-team" class="p-4 md:p-10 mt-10 md:mt-20">
      <div class="py-5 bg-[#F9F9FE] rounded-3">
        <div class="text-center mb-5">
          <p class="text-[#80BCBD] text-xl md:text-2xl font-light">/ OUR TEAM</p>
          <h1 class="font-bold text-4xl md:text-6xl mb-2">Tim dari BersihinAja</h1>
        </div>
        <div class="flex flex-col md:flex-row justify-center gap-4">
          <?php $limited_pekerja = array_slice($user, 0, 3); ?>
          <?php foreach ($limited_pekerja as $pekerja): ?>
            <div class="service-card w-full md:w-1/3 shadow-md rounded-3 py-3">
              <div class="relative">
                <img src="<?php echo $this->config->item('url_customer') . $pekerja['Foto_User']; ?>"
                  alt="<?= $pekerja['Nama_User']; ?>"
                  class="w-full h-60 object-cover rounded-3">
                <h5 class="absolute bottom-0 left-1/2 transform -translate-x-1/2 mb-4 bg-white text-black text-sm font-bold px-4 py-2 rounded">
                  <?= $pekerja['Nama_User']; ?>
                </h5>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="bg-[#80BCBD] p-6 rounded-3 flex flex-col items-center mt-3">
          <h3 class="text-white font-bold text-xl md:text-3xl mb-4">Bergabunglah dengan Tim Impian Kebersihan Kami!</h3>
          <a class="service-card btn btn-light rounded-3" href="<?php echo base_url('praregist') ?>">Bergabunglah Dengan Kami!</a>
        </div>
      </div>
    </section>

    <section id="testimonials" class="p-4 md:p-10 mt-10">
      <div class="py-5">
        <div class="text-start mb-5">
          <p class="text-[#80BCBD] text-xl md:text-2xl font-light">/ TESTIMONIALS</p>
          <h1 class="font-bold text-4xl md:text-6xl">Hasil Review<br>Customer Kami</h1>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
          <?php
          $reviews = [
            [
              'name' => 'Joni',
              'service' => 'Home Cleaning',
              'text' => 'Pelayanannya cepat dan bersih banget. Rumah jadi wangi dan rapi dalam waktu singkat. Recommended!'
            ],
            [
              'name' => 'Sarah',
              'service' => 'Home Cleaning',
              'text' => 'Pelayanannya sangat ramah dan profesional. Rumah jadi bersih dan rapi. Terima kasih!'
            ],
            [
              'name' => 'Raka',
              'service' => 'AC Service',
              'text' => 'Teknisi datang tepat waktu dan AC langsung dingin seperti baru. Harganya juga terjangkau.'
            ],
            [
              'name' => 'Maya',
              'service' => 'Cuci Sofa',
              'text' => 'Sofa keluarga jadi wangi dan bersih. Anak-anak jadi betah duduk berlama-lama. Terima kasih!'
            ]
          ];

          foreach ($reviews as $review): ?>
            <div class="service-card shadow-md border rounded-3 p-3 w-full md:w-1/4">
              <h5><?= $review['name'] ?></h5>
              <p><?= $review['service'] ?></p>
              <p><?= $review['text'] ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>