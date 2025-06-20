<?php 
include 'midtrans-php/Midtrans.php';

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-sDOZNKYY7IIJOfOJg5nlBWr3';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

?>

<div class="container py-5">
    <div class="card shadow border-0 p-4">
        <h1 class="fw-bold text-primary mb-4">Checkout</h1>

        <!-- Detail Layanan -->
        <div class="card mb-4">
                <div class="card-body">
                    <h3 class="fw-bold">Detail Layanan</h3>
                    <div class="card-body text-center">
                    <img src="<?= base_url('uploads/layanan/' . $detail_layanan['Foto_Layanan']); ?>" alt="<?= $detail_layanan['Nama_Layanan']; ?>" class="img-fluid" style="max-height: 300px;">
                </div>
                <p><strong>Nama Layanan:</strong> <?= $detail_layanan['Nama_Layanan']; ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($detail_layanan['Harga'], 0, ',', '.'); ?></p>
                <p><strong>Estimasi:</strong> <?= $detail_layanan['Estimasi']; ?> jam</p>
            </div>
        </div>

        <!-- Paket yang Dipilih -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Paket yang Dipilih</h3>
                <?php if (!empty($paket_detail)): ?>
                    <ul>
                        <?php foreach ($paket_detail as $paket): ?>
                            <li><?= $paket['Nama_Paket']; ?> - Rp <?= number_format($paket['Harga'], 0, ',', '.'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Tidak ada paket yang dipilih.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pekerja yang Dipilih -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Pekerja yang Dipilih</h3>
                <?php if (!empty($pekerja_detail)): ?>
                    <ul>
                        <?php foreach ($pekerja_detail as $pekerja): ?>
                            <li><?= $pekerja['Nama_User']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Tidak ada pekerja yang dipilih.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Total Harga -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Total Harga</h3>
                <p class="fs-4 text-success">Rp <?= number_format($total_harga, 0, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Form Konfirmasi -->
        <form action="<?= base_url('service_detail/saveOrder'); ?>" method="post">
            <input type="hidden" name="id_services" value="<?= $detail_layanan['Id_Services']; ?>">
            <?php foreach ($paket_detail as $paket): ?>
                <input type="hidden" name="paket[]" value="<?= $paket['Id_Paket']; ?>">
            <?php endforeach; ?>
            <?php foreach ($pekerja_detail as $pekerja): ?>
                <input type="hidden" name="selected_pekerja[]" value="<?= $pekerja['Id_User']; ?>">
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary w-100 mb-3">Konfirmasi Pesanan</button>
        </form>

        <a href="<?= base_url('services'); ?>" class="btn btn-secondary w-100">Kembali</a>
    </div>
</div>