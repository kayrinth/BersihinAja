<main style="margin-top: 58px">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Pemesanan</h5>
          </div>
          <div class="card-body">
            <?php if (!empty($detail_pemesanan)): ?>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Tanggal Order</th>
                      <th>Customer</th>
                      <th>Layanan</th>
                      <th>Paket</th>
                      <th>Total</th>
                      <th>Ulasan</th>
                      <th>Rating</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($detail_pemesanan as $index => $pemesanan): ?>
                      <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo date('d M Y', strtotime($pemesanan['Tanggal_Order'])); ?></td>
                        <td><?php echo $pemesanan['Nama_Customer']; ?></td>
                        <td><?php echo $pemesanan['Nama_Layanan']; ?></td>
                        <td><?php echo $pemesanan['Nama_Paket']; ?></td>
                        <td>Rp <?php echo number_format($pemesanan['Total'], 0, ',', '.'); ?></td>
                        <td><?php echo !empty($pemesanan['Ulasan']) ? $pemesanan['Ulasan'] : 'Belum diulas'; ?></td>
                        <td>
                          <?php if (!empty($pemesanan['Jumlah_Rating'])): ?>
                            <span class="text-warning">
                              <?php for ($i = 0; $i < $pemesanan['Jumlah_Rating']; $i++): ?>
                                &#9733;
                              <?php endfor; ?>
                              <?php for ($i = $pemesanan['Jumlah_Rating']; $i < 5; $i++): ?>
                                &#9734;
                              <?php endfor; ?>
                            </span>
                          <?php else: ?>
                            <span class="text-muted">Belum ada rating</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <form method="post" action="<?php echo base_url('pekerja/Transaksi/updateStatus'); ?>">
                            <input type="hidden" name="id_detail_pemesanan" value="<?php echo $pemesanan['Id_Detail_Pemesanan']; ?>">
                            <input type="hidden" name="id_pekerja" value="<?php echo $pemesanan['Id_Pekerja']; ?>">
                            <button
                              type="submit"
                              class="btn btn-success btn-sm"
                              <?php echo ($pemesanan['Status_Order'] === 'Selesai') ? 'disabled' : ''; ?>>
                              <?php echo ($pemesanan['Status_Order'] === 'Selesai') ? 'Selesai' : 'Tandai Selesai'; ?>
                            </button>
                          </form>
                        </td>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="alert alert-info text-center mb-0">
                Tidak ada detail pemesanan untuk saat ini.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>