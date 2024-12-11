<div class="container py-4">
	<div class="row">
		<div class="col-md-6">
			<!-- Gambar Layanan -->
			<img src="<?= base_url('./assets/layanan/' . $detail_layanan['Foto_Layanan']); ?>" class="w-100" alt="<?= $detail_layanan['Nama_Layanan']; ?>">
		</div>
		<div class="col-md-6">
			<!-- Informasi Layanan -->
			<h1 class="fw-bold"><?= $detail_layanan['Nama_Layanan']; ?></h1>
			<span class="badge bg-primary">Ukuran: <?= $detail_layanan['Ukuran_Ruangan']; ?> m<sup>2</sup></span>
			<p class="fs-4 mt-3 text-success">Rp <?= number_format($detail_layanan['Harga'], 0, ',', '.'); ?></p>

			<!-- Form Pemesanan -->
			<?php if ($this->session->userdata('logged_in')): ?>
				<form method="post" action="<?= base_url('service_detail/order'); ?>" class="my-3">
					<!-- Input Jumlah -->
					<div class="mb-3">
						<label for="jumlah" class="form-label">Jumlah</label>
						<input type="number" id="jumlah" name="jumlah" class="form-control" min="1" placeholder="Masukkan jumlah">
					</div>

					<!-- Dropdown untuk Paket -->
					<div class="mb-3">
						<label for="paket" class="form-label">Pilih Paket</label>
						<select id="paket" name="paket" class="form-select">
							<?php foreach ($paket as $item): ?>
								<option value="<?= $item['id_paket']; ?>">
									<?= $item['nama_paket']; ?> - Rp <?= number_format($item['harga_paket'], 0, ',', '.'); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<!-- Tombol Pesan -->
					<button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
				</form>
			<?php else: ?>
				<p class="text-danger">Silakan login untuk memesan layanan ini.</p>
			<?php endif; ?>

			<!-- Deskripsi Layanan -->
			<p class="mt-4">Estimasi pengerjaan: <?= $detail_layanan['Estimasi']; ?> jam.</p>
			
		</div>
	</div>
</div>