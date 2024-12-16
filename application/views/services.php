<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BersihinAja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
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
  <div class="relative h-full w-full bg-cover bg-center p-20"
    style="background-image: url('./assets/service.png');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative flex flex-col justify-center h-full ">
      <h1 class="text-white text-4xl font-bold text-center">
        Bergabunglah Bersama Kami.
      </h1>
      <p class="text-white text-center text-2xl font-light">Bergabung bersama BersihinAja sekarang dan rasakan<br>manfaat sosial bagi Anda dan sekitar.</p>
    </div>
  </div>

  <section id="testimonials" class="p-10 mt-0">
    <div class="container py-5">
      <div class="flex flex-row">
        <?php foreach ($services as $s): ?>
          <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
            <a href="<?= base_url('service_detail?id=' . $s['Id_Services']); ?>" class="text-decoration-none">
              <div class="flex justify-content-end flex-col text-center">
                <img src="<?= base_url('./assets/layanan/' . $s['Foto_Layanan']); ?>" alt="<?= $s['Nama_Layanan']; ?>" class="w-full rounded-3 my-2">
                <h5><?= $s['Nama_Layanan']; ?></h5>
                <h2>
                  <span class="text-[#80BCBD] text-lg">Rp</span>
                  <span class="text-4xl"><?= number_format($s['Harga'], 0, ',', '.'); ?></span>
                </h2>
                <p class="text-lg">Untuk ukuran ruangan <span class="text-[#80BCBD] font-bold"> <?= $s['Ukuran_Ruangan']; ?> m<sup>2</sup></span></p>
                <p>
                  <span class="text-lg">Maksimal pengerjaan <?= $s['Maksimal_Jam']; ?> jam</span><br>
                  <span class="text-sm">(Est. <?= $s['Estimasi']; ?>)</span>
                </p>
                <p class="text-lg"><?= $s['Jumlah_Cleaner']; ?> Cleaner</p>
              </div>
            </a>
          </div>

        <?php endforeach; ?>
        <!-- <div class="service-card col-md-3 w-full h-full shadow-md border-1 rounded-3 mx-1">
          <div class="flex justify-content-end flex-col text-center">
            <img src="https://picsum.photos/200" alt="" class="w-full rounded-3 my-2">
            <div class="icon">
              <i class="bi bi-house"></i>
            </div>
            <h5>Small</h5>
            <p>Get your home cleaned by our professional cleaning team.</p>
          </div>
        </div> -->
      </div>
    </div>
  </section>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>