<main style="margin-top: 58px">
	<div class="container">
		<h5>Edit layanan</h5>

		<form method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label>Nama Layanan</label>
				<input type="text" name="Nama_Layanan" class="form-control" value="<?php echo set_value("Nama_Layanan", $jenis_layanan['Nama_Layanan']) ?>">
				<span class="text-danger small">
					<?php echo form_error("Nama_Layanan"); ?>
				</span>
			</div>

			<div class="mb-3">
				<label>Harga Layanan</label>
				<input type="text" name="Harga" value="<?php echo $jenis_layanan['Harga'] ?>" class="form-control">
				<span class="text-danger small">
					<?php echo form_error("Harga"); ?>
				</span>
			</div>

			<div class="mb-3">
				<label>Ukuran_Ruangan</label>
				<input type="text" name="Ukuran_Ruangan" class="form-control" value="<?php echo set_value("Ukuran_Ruangan", $jenis_layanan['Ukuran_Ruangan']) ?>">
				<span class="text-danger small">
					<?php echo form_error("Ukuran_Ruangan"); ?>
				</span>
			</div>

			<div class="mb-3">
				<label>Maksimal_Jam</label>
				<input type="text" name="Maksimal_Jam" value="<?php echo $jenis_layanan['Maksimal_Jam'] ?>" class="form-control">
				<span class="text-danger small">
					<?php echo form_error("Maksimal_Jam"); ?>
				</span>
			</div>

			<div class="mb-3">
				<label>Estimasi</label>
				<input type="text" name="Estimasi" class="form-control" value="<?php echo set_value("Estimasi", $jenis_layanan['Estimasi']) ?>">
				<span class="text-danger small">
					<?php echo form_error("Estimasi"); ?>
				</span>
			</div>

			<div class="mb-3">
				<label>Jumlah_Cleaner</label>
				<input type="text" name="Jumlah_Cleaner" value="<?php echo $jenis_layanan['Jumlah_Cleaner'] ?>" class="form-control">
				<span class="text-danger small">
					<?php echo form_error("Jumlah_Cleaner"); ?>
				</span>
			</div>

			<div class="mb-3">
				<label>Deskripsi</label>

				<textarea name="Deskripsi" id="editorku" class="form-control"><?php echo set_value("Deskripsi", $jenis_layanan['Deskripsi']) ?>
				</textarea>

				<span class="text-danger small">
					<?php echo form_error("Deskripsi"); ?>
				</span>
			</div>

			<div class="mb-3">
				<label>Image</label><br>
				<img src="<?php echo $this->config->item("url_layanan") . $jenis_layanan["Foto_Layanan"] ?>" width="300">
			</div>

			<div class="mb-3">
				<label>Ganti Image layanan</label>
				<input type="file" name="Foto_Layanan" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>
</main>