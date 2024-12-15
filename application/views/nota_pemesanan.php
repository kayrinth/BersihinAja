<?php
include 'midtrans-php/Midtrans.php';

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-sDOZNKYY7IIJOfOJg5nlBWr3';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;


$total_harga = $detail_layanan['Harga'];
if (!empty($paket_detail)) {
    foreach ($paket_detail as $paket) {
        $total_harga += $paket['Harga'];
    }
}

$params['transaction_details']['order_id'] = $detail_pemesanan['Id_Detail_Pemesanan'];
$params['transaction_details']['gross_amount'] = $total_harga;
$snapToken = \Midtrans\Snap::getSnapToken($params);
?>

<div class="container py-5">
    <div class="card shadow border-0 p-4">
        <h1 class="fw-bold text-primary mb-4">Nota Pemesanan</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Detail Pelanggan</h3>
                <p><strong>Customer ID:</strong> <?= isset($user_data['Id_User']) ? $user_data['Id_User'] : 'N/A'; ?></p>
                <p><strong>Nama:</strong> <?= isset($user_data['Nama_User']) ? $user_data['Nama_User'] : 'N/A'; ?></p>
                <p><strong>Email:</strong> <?= isset($user_data['Email_User']) ? $user_data['Email_User'] : 'N/A'; ?></p>
                <p><strong>Alamat:</strong> <?= isset($user_data['Alamat_User']) ? $user_data['Alamat_User'] : 'N/A'; ?></p>
            </div>
        </div>


        <!-- Detail Layanan -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Detail Layanan</h3>
                <p><strong>Nama Layanan:</strong> <?= !empty($detail_layanan['Nama_Layanan']) ? $detail_layanan['Nama_Layanan'] : 'N/A'; ?></p>
                <p><strong>Ukuran:</strong> <?= !empty($detail_layanan['Ukuran_Ruangan']) ? $detail_layanan['Ukuran_Ruangan'] . ' m<sup>2</sup>' : 'N/A'; ?></p>
                <p><strong>Harga:</strong> <?= !empty($detail_layanan['Harga']) ? 'Rp ' . number_format($detail_layanan['Harga'], 0, ',', '.') : 'N/A'; ?></p>
                <p><strong>Estimasi:</strong> <?= !empty($detail_layanan['Estimasi']) ? $detail_layanan['Estimasi'] . ' jam' : 'N/A'; ?></p>
            </div>
        </div>

        <!-- Paket yang Dipilih -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Paket yang Dipilih</h3>
                <div class="row">
                    <?php if (!empty($paket_detail)): ?>
                        <?php foreach ($paket_detail as $paket): ?>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <p class="mb-0"><strong><?= $paket['Nama_Paket']; ?></strong></p>
                                        <p class="text-success">Rp <?= number_format($paket['Harga'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada paket yang dipilih</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Pekerja yang Dipilih -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Pekerja yang Dipilih</h3>
                <div class="row">
                    <?php if (!empty($pekerja_detail)): ?>
                        <?php foreach ($pekerja_detail as $pekerja): ?>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm d-flex align-items-center p-2">
                                    <img src="<?= $this->config->item('url_customer') . $pekerja['Foto_User']; ?>" alt="<?= $pekerja['Nama_User']; ?>" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                                    <p class="mb-0 fw-bold"><?= $pekerja['Nama_User']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada pekerja yang dipilih</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Total Harga -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="fw-bold">Total Harga</h3>
                <p class="fs-4 text-success">
                    Rp <?= isset($detail_layanan['Harga']) ? number_format($detail_layanan['Harga'] + array_sum(array_column($paket_detail ?? [], 'Harga')), 0, ',', '.') : 'N/A'; ?>
                </p>
            </div>
        </div>

        <!-- Tombol -->
        <form action="<?= base_url('service_detail/saveOrder'); ?>" method="post">
            <input type="hidden" name="id_services" value="<?= $detail_layanan['Id_Services']; ?>">
            <input type="hidden" name="alamat" value="<?= isset($user_data['Alamat_User']) ? $user_data['Alamat_User'] : ''; ?>">

            <?php foreach ($paket_detail as $paket): ?>
                <input type="hidden" name="paket[]" value="<?= $paket['Id_Paket']; ?>">
            <?php endforeach; ?>

            <?php foreach ($pekerja_detail as $pekerja): ?>
                <input type="hidden" name="selected_pekerja[]" value="<?= $pekerja['Id_User']; ?>">
            <?php endforeach; ?>

            <button type="button" class="btn btn-primary w-100 mb-3" id="pay-button">Submit Pesanan</button>
            <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>
        </form>
        <a href="<?= base_url('services'); ?>" class="btn btn-secondary w-100">Kembali</a>
    </div>
</div>

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-D-4z0cOLlQa1lamX"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('<?= $snapToken ?>', {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>