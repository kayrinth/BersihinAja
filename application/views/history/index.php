<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Riwayat Transaksi</h1>

    <?php if (empty($transactions)): ?>
        <p class="text-gray-600">Anda belum memiliki riwayat transaksi.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Order ID</th>
                        <th class="py-3 px-6 text-left">Total</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($transactions as $transaction): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6"><?= $transaction->order_id ?></td>
                            <td class="py-3 px-6">Rp <?= number_format($transaction->Total, 0, ',', '.') ?></td>
                            <td class="py-3 px-6">
                                <?php
                                switch ($transaction->Status_Pembayaran) {
                                    case 'pending':
                                        echo '<span class="text-yellow-500">Pending</span>';
                                        break;
                                    case 'success':
                                        echo '<span class="text-green-500">Berhasil</span>';
                                        break;
                                    case 'failed':
                                        echo '<span class="text-red-500">Gagal</span>';
                                        break;
                                    default:
                                        echo '<span class="text-gray-500">' . $transaction->Status_Pembayaran . '</span>';
                                }
                                ?>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <?php if ($transaction->Status_Pembayaran == 'Belum Dibayar'): ?>
                                    <a href="<?= base_url('history/repay/' . $transaction->order_id) ?>"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Bayar Ulang
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>