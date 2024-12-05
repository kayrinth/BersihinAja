<div class="container py-4">
	<div class="row">
		<div class="col-md-6">
			<!-- Gambar Produk -->
			<img src="/bersihinAja/assets/6856377.png" class="w-100">
		
		</div>
		<div class="col-md-6">
			<!-- Informasi Produk -->
			<h1 class="fw-bold">Nama Produk</h1>
			<span class="badge bg-primary">Kategori Produk</span>
			<p class="fs-4 mt-3 text-success">Rp <?= number_format(100000, 0, ',', '.'); ?></p>

			<!-- Form Pembelian -->
			<?php if (true): // Ganti kondisi ini sesuai dengan logika login Anda ?>
				<form method="post" action="<?= base_url('produk/beli'); ?>" class="my-3">
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

					<!-- Tombol Beli -->
					<button type="submit" class="btn btn-primary w-100">Beli Sekarang</button>
				</form>
			<?php endif; ?>

			<!-- Deskripsi Produk -->
			<p class="mt-4">Deskripsi lengkap produk akan ditampilkan di sini.</p>
		</div>
	</div>
</div>
