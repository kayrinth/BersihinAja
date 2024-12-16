<div class="container py-5">
	<!-- Gambar Layanan di Atas -->
	<div class="row g-4">
		<div class="col-12">
			<div class="card shadow border-0">
				<img src="<?= base_url('./assets/layanan/' . $detail_layanan['Foto_Layanan']); ?>"
					class="card-img-top rounded"
					alt="<?= $detail_layanan['Nama_Layanan']; ?>">
			</div>
		</div>
	</div>

	<!-- Informasi dan Formulir -->
	<div class="row g-4 align-items-start mt-4">
		<!-- Kolom Informasi Layanan -->
		<div class="col-md-6">
			<div class="px-3">
				<h1 class="fw-bold text-primary mb-3">
					<?= $detail_layanan['Nama_Layanan']; ?>
				</h1>
				<span class="badge bg-primary mb-3">
					Ukuran: <?= $detail_layanan['Ukuran_Ruangan']; ?> m<sup>2</sup>
				</span>
				<p class="fs-3 text-success">
					Rp <?= number_format($detail_layanan['Harga'], 0, ',', '.'); ?>
				</p>
				<p class="mt-4 text-muted">
					<i class="bi bi-clock"></i> Estimasi pengerjaan: <?= $detail_layanan['Estimasi']; ?> jam.
				</p>
				<p class="mt-4 text-muted">
					Deskripsi: <br><?= $detail_layanan['Deskripsi']; ?>
				</p>
			</div>
		</div>

		<!-- Kolom Formulir Pemesanan -->
		<div class="col-md-6">
			<div class="px-3">
				<form method="post" action="<?= base_url('service_detail/order'); ?>" class="mt-4">
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

					<!-- Card untuk Memilih Pekerja -->
					<div class="mb-3">
						<label for="pekerja" class="form-label">Pilih Pekerja</label>
						<div class="row g-2">
							<?php $limited_pekerja = array_slice($pekerja, 0, 3); ?>
							<?php foreach ($limited_pekerja as $pekerja): ?>
								<div class="service-card col-md-3 w-full h-full shadow-md rounded-3 mx-1 py-3">
									<div class="relative">
										<img src="<?php echo $this->config->item('url_customer') . $pekerja['Foto_User']; ?>"
											alt="<?= $pekerja['Nama_User']; ?>"
											class="w-full h-full object-cover rounded-3">
										<h5 class="absolute bottom-0 left-1/2 transform -translate-x-1/2 mb-4 bg-white text-black text-sm font-bold px-4 py-2 rounded">
											<?= $pekerja['Nama_User']; ?>
										</h5>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- Tombol Pesan -->
					<button type="submit" class="btn btn-primary w-100 py-2">
						Pesan Sekarang
					</button>
				</form>
			</div>
		</div>
	</div>
</div>