<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Riwayat Transaksi</h1>

        <?php if (empty($transactions)): ?>
            <p class="text-gray-600">Anda belum memiliki riwayat transaksi.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Tanggal Order</th>
                            <th class="py-3 px-6 text-left">Pekerja</th>
                            <th class="py-3 px-6 text-left">Layanan</th>
                            <th class="py-3 px-6 text-left">Paket</th>
                            <th class="py-3 px-6 text-left">Total</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php foreach ($transactions as $transaction): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6"><?= $transaction->Tanggal_Order ?></td>
                                <td class="py-3 px-6"><?= $transaction->nama_pekerja ?></td>
                                <td class="py-3 px-6"><?= $transaction->Nama_Layanan ?></td>

                                <td class="py-3 px-6"><?= isset($transaction->nama_paket) ? $transaction->nama_paket : '-' ?></td>
                                <td class="py-3 px-6">Rp <?= number_format($transaction->Total, 0, ',', '.') ?></td>
                                <td class="py-3 px-6">
                                    <?php
                                    $status = strtolower($transaction->Status_Pembayaran);
                                    switch ($status) {
                                        case 'pending':
                                            echo '<span class="text-yellow-500">Pending</span>';
                                            break;
                                        case 'success':
                                            echo '<span class="text-green-500">Berhasil</span>';
                                            break;
                                        case 'failed':
                                            echo '<span class="text-red-500">Dibatalkan</span>';
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
                                    <?php elseif ($transaction->Status_Pembayaran == 'Dibayar'): ?>
                                        <?php if (empty($transaction->Jumlah_Rating)): ?>
                                            <button onclick="showRatingForm('<?= $transaction->order_id ?>')"
                                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                Beri Ulasan
                                            </button>

                                            <!-- Form Rating Modal -->
                                            <div id="ratingForm-<?= $transaction->order_id ?>" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                                                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                                    <form action="<?= base_url('history/submit_rating') ?>" method="post" class="space-y-4">
                                                        <input type="hidden" name="order_id" value="<?= $transaction->order_id ?>">

                                                        <div class="flex flex-col space-y-2">
                                                            <label class="font-medium">Rating</label>
                                                            <div class="flex flex-row-reverse justify-end space-x-2 space-x-reverse">
                                                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                                                    <input type="radio" id="star<?= $i ?>-<?= $transaction->order_id ?>"
                                                                        name="rating" value="<?= $i ?>" class="hidden peer">
                                                                    <label for="star<?= $i ?>-<?= $transaction->order_id ?>"
                                                                        class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">
                                                                        ★
                                                                    </label>
                                                                <?php endfor; ?>
                                                            </div>
                                                        </div>

                                                        <div class="flex flex-col space-y-2">
                                                            <label class="font-medium">Ulasan</label>
                                                            <textarea name="ulasan" rows="4"
                                                                class="border rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                placeholder="Tulis ulasan Anda di sini..."></textarea>
                                                        </div>

                                                        <div class="flex justify-end space-x-2">
                                                            <button type="button"
                                                                onclick="hideRatingForm('<?= $transaction->order_id ?>')"
                                                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                                                                Batal
                                                            </button>
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                                Kirim
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="flex flex-col items-center">
                                                <div class="flex">
                                                    <?php for ($i = 1; $i <= $transaction->Jumlah_Rating; $i++): ?>
                                                        <span class="text-yellow-400">★</span>
                                                    <?php endfor; ?>
                                                </div>
                                                <p class="text-sm mt-1"><?= $transaction->Ulasan ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function showRatingForm(orderId) {
            document.getElementById('ratingForm-' + orderId).classList.remove('hidden');
        }

        function hideRatingForm(orderId) {
            document.getElementById('ratingForm-' + orderId).classList.add('hidden');
        }
    </script>
</body>

</html>