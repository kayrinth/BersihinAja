<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BersihinAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <main style="margin-top: 58px">
        <div class="container">
            <h5>Data Transaksi</h5>
            <table class="table table-bordered" id="tabelku">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transaksi) && is_array($transaksi)): ?>
                        <?php foreach ($transaksi as $k => $v): ?>
                            <tr>
                                <td><?php echo $k + 1; ?></td>
                                <td><?php echo $v['tanggal_transaksi']; ?></td>
                                <td><?php echo $v['total_transaksi']; ?></td>
                                <td><?php echo $v['status_transaksi']; ?></td>
                                <td>
                                    <a href="<?php echo base_url("transaksi/detail/" . $v["id_transaksi"]) ?>" class="btn btn-info">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </main>


    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>