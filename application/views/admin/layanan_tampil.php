<main style="margin-top: 58px">
  <div class="container">

        <h5>Data layanan</h5>

        <table class="table table-bordered" id="tabelku">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Image</th>
              <th>Ukuran_ruangan</th>
              <th>Maksimal_jam</th>
              <th>Estimasi</th>
              <th>Jumlah_cleaner</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($jenis_layanan as $k => $v): ?>

            <tr>
              <td><?php echo $k +1; ?></td>
              <td><?php echo $v['Nama_Layanan']; ?></td>
              <td><?php echo $v['Harga']; ?></td>
              <td>
                <img src="<?php echo $this->config->item("url_layanan").$v["Foto_Layanan"] ?>" width="200">
              </td>
              <td><?php echo $v['Ukuran_Ruangan']; ?></td>
              <td><?php echo $v['Maksimal_Jam']; ?></td>
              <td><?php echo $v['Estimasi']; ?></td>
              <td><?php echo $v['Jumlah_Cleaner']; ?></td>
              <td>
                <a href="<?php echo base_url("admin/layanan/edit/".$v["Id_Services"]) ?>"  class="btn btn-warning">Edit</a>
                <a href="<?php echo base_url("admin/layanan/hapus/".$v["Id_Services"]) ?>" class="btn btn-danger">Hapus</a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <a href="<?php echo base_url("admin/layanan/tambah") ?>" class="btn btn-primary">Tambah Data</a>
  </div>
</main>