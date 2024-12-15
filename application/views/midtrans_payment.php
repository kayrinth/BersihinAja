<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Pembayaran Midtrans
                </div>
                <div class="card-body">
                    <h5>Detail Pesanan</h5>
                    <p>Total Pembayaran: Rp <?= number_format($detail_pemesanan['Total'], 0, ',', '.'); ?></p>
                    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.midtrans.com/snap/snap.js"></script>
<script>
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        snap.pay('<?= $snapToken ?>', {
            onSuccess: function(result) {
                alert('Pembayaran Berhasil!');
                window.location.href = '<?= base_url('services') ?>';
            },
            onPending: function(result) {
                alert('Pembayaran Pending');
            },
            onError: function(result) {
                alert('Pembayaran Gagal');
            }
        });
    });
</script>