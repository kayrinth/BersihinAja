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
    <div class="container mx-auto py-5">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($services as $s): ?>
          <div class="service-card bg-white w-full shadow-md border rounded-3 p-4">
            <a href="<?= base_url('service_detail?id=' . $s['Id_Services']); ?>" class="text-decoration-none">
              <div class="flex flex-col items-center text-center">
                <img src="<?= base_url('./assets/layanan/' . $s['Foto_Layanan']); ?>" alt="<?= $s['Nama_Layanan']; ?>" class="w-full rounded-3 my-2 object-cover">
                <h5 class="text-lg font-semibold"><?= $s['Nama_Layanan']; ?></h5>
                <h2>
                  <span class="text-[#80BCBD] text-lg">Rp</span>
                  <span class="text-2xl font-bold"><?= number_format($s['Harga'], 0, ',', '.'); ?></span>
                </h2>
                <p class="text-base">Untuk ukuran ruangan <span class="text-[#80BCBD] font-bold"> <?= $s['Ukuran_Ruangan']; ?> m<sup>2</sup></span></p>
                <p class="text-sm">
                  Maksimal pengerjaan <?= $s['Maksimal_Jam']; ?> jam<br>
                  <span class="text-gray-500">(Est. <?= $s['Estimasi']; ?>)</span>
                </p>
                <p class="text-base"><?= $s['Jumlah_Cleaner']; ?> Cleaner</p>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>