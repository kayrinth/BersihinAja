<?php if (isset($transaksi) && !empty($transaksi)): ?>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Status</th>
        <th>Nama Pekerja</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($transaksi as $key => $t) : ?>
        <tr>
          <td><?= $key + 1; ?></td>
          <td><?= $t->Tanggal_Order; ?></td>
          <td><?= $t->Total; ?></td>
          <td><?= $t->Status_Pembayaran; ?></td>
          <td>
            <?php
            // Menampilkan nama pekerja
            if (isset($t->pekerja)) {
              foreach ($t->pekerja as $pekerja) {
                echo $pekerja['nama'] . '<br>';
              }
            }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>Tidak ada data transaksi.</p>
<?php endif; ?>