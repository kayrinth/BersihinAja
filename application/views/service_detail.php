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
				<input type="hidden" name="id_services" value="<?= $detail_layanan['Id_Services']; ?>">
					<div class="mb-3">
						<label class="form-label">Pilih Paket</label>
						<div class="row">
							<?php foreach ($paket as $item): ?>
								<div class="col-md-6">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="paket[]" id="paket_<?= $item['Id_Paket']; ?>" value="<?= $item['Id_Paket']; ?>">
										<label class="form-check-label" for="paket_<?= $item['Id_Paket']; ?>">
											<?= $item['Nama_Paket']; ?> - <span class="text-success">Rp <?= number_format($item['Harga'], 0, ',', '.'); ?></span>
										</label>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>


					<div class="mb-3">
						<label for="pekerja" class="form-label">Pilih Pekerja</label>
						<div class="row g-3">
							<?php foreach ($pekerja as $v): ?>
								<div class="col-md-3">
									<div class="card pekerja-card" onclick="toggleSelection(<?= $v['Id_User']; ?>)">
										<img src="<?= $this->config->item('url_customer') . $v['Foto_User']; ?>" alt="<?= $v['Nama_User']; ?>" class="card-img-top">
										<div class="card-body text-center">
											<h5 class="card-title"><?= $v['Nama_User']; ?></h5>
										</div>
										<input type="checkbox" name="selected_pekerja[]" value="<?= $v['Id_User']; ?>" id="pekerja_<?= $v['Id_User']; ?>" hidden>
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

<script>
	function toggleSelection(id) {
		const checkbox = document.getElementById(`pekerja_${id}`);
		checkbox.checked = !checkbox.checked;

		const card = checkbox.closest('.pekerja-card');
		card.classList.toggle('selected', checkbox.checked);
	}
</script>

<style>
	.pekerja-card {
		cursor: pointer;
		border: 1px solid #ddd;
		transition: transform 0.2s;
	}

	.pekerja-card.selected {
		border-color: #007bff;
		transform: scale(1.05);
	}
</style>