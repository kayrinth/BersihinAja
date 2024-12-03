<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Customer</title>
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
    </style>
</head>

<body>
    <main style="margin-top: 58px">
        <div class="container mt-5">
            <h5>Daftar Customer</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $k => $v): ?>
                        <tr>
                            <td><?= $k + 1; ?></td>
                            <td><?= htmlspecialchars($v['Nama_User']); ?></td>
                            <td><?= htmlspecialchars($v['Email_User']); ?></td>
                            <td><?= htmlspecialchars($v['No_Hp']); ?></td>
                            <td>
                                <a href="<?= base_url("pekerja/customer/" . $v['Id_User']); ?>" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>