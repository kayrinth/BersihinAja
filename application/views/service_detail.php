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

					<!-- Pilih Paket -->
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

					<!-- Pilih Pekerja -->
					<div class="mb-3">
						<label for="pekerja" class="form-label">Pilih Pekerja</label>
						<div class="row g-3">
							<?php foreach ($pekerja as $v): ?>
								<div class="col-md-3">
									<div class="card pekerja-card" onclick="toggleSelection(<?= $v['Id_User']; ?>)">
										<img src="<?= $this->config->item('url_customer') . $v['Foto_User']; ?>"
											alt="<?= $v['Nama_User']; ?>"
											class="card-img-top">
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

<!-- JavaScript -->
<script>
	const pekerjaCheckboxes = document.querySelectorAll('input[name="selected_pekerja[]"]');
	let selectedIds = []; // Untuk menyimpan ID pekerja yang terpilih

	// Ambil ID layanan dari URL
	const urlParams = new URLSearchParams(window.location.search);
	const serviceId = parseInt(urlParams.get('id'), 10); // ID layanan dari URL
	let maxSelection = pekerjaCheckboxes.length; // Default tanpa batasan

	function toggleSelection(id) {
		const checkbox = document.getElementById(`pekerja_${id}`);
		const card = checkbox.closest('.pekerja-card');

		// Tentukan batasan berdasarkan ID layanan
		if (serviceId === 1) {
			maxSelection = 1; // ID layanan 1: Maksimal 1 pekerja
		} else if (serviceId === 2) {
			maxSelection = 3; // ID layanan 2: Maksimal 3 pekerja
		} else {
			maxSelection = pekerjaCheckboxes.length; // Default: Tidak ada batas
		}

		if (checkbox.checked) {
			// Hapus jika batal dipilih
			checkbox.checked = false;
			card.classList.remove('selected');
			selectedIds = selectedIds.filter(e => e !== id);
		} else {
			// Tambahkan jika dipilih
			if (selectedIds.length < maxSelection) {
				checkbox.checked = true;
				card.classList.add('selected');
				selectedIds.push(id);
			} else {
				alert(`Maksimal hanya ${maxSelection} pekerja yang dapat dipilih!`);
			}
		}
	}

	function validateBeforeSubmit() {
			// Validasi minimal 1 pekerja dipilih
			if (selectedIds.length === 0) {
				alert("Anda wajib memilih minimal satu pekerja!");
				return false;
			}
			return true;
		}

		// Tambahkan event listener submit form
		document.querySelector('form').addEventListener('submit', function(e) {
			if (!validateBeforeSubmit()) {
				e.preventDefault(); // Stop submit jika validasi gagal
			}
		});

</script>


<!-- CSS -->
<style>
	.pekerja-card {
		cursor: pointer;
		border: 1px solid #ddd;
		transition: transform 0.2s, border-color 0.2s;
	}

	.pekerja-card.selected {
		border-color: #007bff;
		transform: scale(1.05);
	}

	.pekerja-card img {
		height: 100px;
		object-fit: cover;
	}
</style>