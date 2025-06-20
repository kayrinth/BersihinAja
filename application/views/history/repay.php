<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Bayar Ulang Transaksi</h1>

        <div class="mb-4">
            <p class="text-gray-600">Order ID: <?= $detail_pemesanan->order_id ?></p>
            <p class="text-gray-600">Total Pembayaran: Rp <?= number_format($detail_pemesanan->Total, 0, ',', '.') ?></p>
        </div>

        <button id="pay-button" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
            Bayar Sekarang
        </button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-D-4z0cOLlQa1lamX"></script>
<script type="text/javascript">
    // Debugging: Pastikan token tersedia
    var snapToken = "<?= isset($snapToken) ? $snapToken : '' ?>";
    console.log('Snap Token Loaded:', snapToken);

    document.getElementById('pay-button').onclick = function() {
        // Tambahkan pengecekan token
        if (!snapToken) {
            alert('Token pembayaran tidak valid');
            return;
        }

        // Logging tambahan
        console.log('Attempting to pay with token:', snapToken);

        try {
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log('Midtrans Payment Success:', result);

                    // Kirim data transaksi ke server
                    fetch('<?= base_url('service_detail/saveTransaction'); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(result),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            console.log('Server response:', data);

                            if (data.status === 'success') {
                                alert('Transaksi berhasil disimpan!');
                                window.location.href = '<?= base_url('services'); ?>';
                            } else {
                                alert('Gagal menyimpan transaksi: ' + data.message);
                            }
                        })
                        .catch((error) => {
                            console.error('Error saving transaction:', error);
                            alert('Terjadi kesalahan saat menyimpan transaksi');
                        });
                },
                onPending: function(result) {
                    console.log('Midtrans Payment Pending:', result);
                    alert('Pembayaran tertunda');
                },
                onError: function(result) {
                    console.error('Midtrans Payment Error:', result);
                    alert('Pembayaran gagal: ' + JSON.stringify(result));
                },
                onClose: function() {
                    console.log('Snap payment page closed');
                }
            });
        } catch (error) {
            console.error('Snap Payment Error:', error);
            alert('Terjadi kesalahan dalam proses pembayaran');
        }
    };
</script>