<div class="container py-5">
    <div class="card shadow border-0 p-4">
        <h1 class="fw-bold text-primary mb-4">Nota Pemesanan</h1>

        <!-- Detail Layanan -->
        <h3 class="fw-bold">Detail Layanan</h3>
        <p><strong>Nama Layanan:</strong> <?= !empty($detail_layanan['Nama_Layanan']) ? $detail_layanan['Nama_Layanan'] : 'N/A'; ?></p>
        <p><strong>Ukuran:</strong> <?= !empty($detail_layanan['Ukuran_Ruangan']) ? $detail_layanan['Ukuran_Ruangan'] . ' m<sup>2</sup>' : 'N/A'; ?></p>
        <p><strong>Harga:</strong> <?= !empty($detail_layanan['Harga']) ? 'Rp ' . number_format($detail_layanan['Harga'], 0, ',', '.') : 'N/A'; ?></p>
        <p><strong>Estimasi:</strong> <?= !empty($detail_layanan['Estimasi']) ? $detail_layanan['Estimasi'] . ' jam' : 'N/A'; ?></p>

        <!-- Paket yang Dipilih -->
        <h3 class="fw-bold mt-4">Paket yang Dipilih</h3>
        <ul>
            <?php if (!empty($paket_detail)): ?>
                <?php foreach ($paket_detail as $paket): ?>
                    <li><?= $paket['Nama_Paket']; ?> - Rp <?= number_format($paket['Harga'], 0, ',', '.'); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Tidak ada paket yang dipilih</li>
            <?php endif; ?>
        </ul>

        <!-- Pekerja yang Dipilih -->
        <h3 class="fw-bold mt-4">Pekerja yang Dipilih</h3>
        <ul class="row">
            <?php if (!empty($pekerja_detail)): ?>
                <?php foreach ($pekerja_detail as $pekerja): ?>
                    <li class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="<?= $this->config->item('url_customer') . $pekerja['Foto_User']; ?>" alt="<?= $pekerja['Nama_User']; ?>" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                            <?= $pekerja['Nama_User']; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Tidak ada pekerja yang dipilih</li>
            <?php endif; ?>
        </ul>

        <!-- Total Harga -->
        <h3 class="fw-bold mt-4">Total Harga</h3>
        <p class="fs-4 text-success">
            Rp <?= isset($detail_layanan['Harga']) ? number_format($detail_layanan['Harga'] + array_sum(array_column($paket_detail ?? [], 'Harga')), 0, ',', '.') : 'N/A'; ?>
        </p>

        <!-- Tombol -->
        <button onclick="window.print()" class="btn btn-primary">Cetak Nota</button>
        <a href="<?= base_url('services'); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
