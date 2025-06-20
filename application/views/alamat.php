<!DOCTYPE html>
<html>

<head>
    <title>Daftar Provinsi</title>
</head>

<body>
    <h1>Pilih Provinsi</h1>

    <!-- Form -->
    <form method="post" action="">
        <label for="provinsi">Provinsi:</label>
        <select name="provinsi" id="provinsi">
            <option value="">-- Pilih Provinsi --</option>
            <?php if (!empty($provinces)): ?>
                <?php foreach ($provinces as $provinsi): ?>
                    <option value="<?= $provinsi['id']; ?>"><?= $provinsi['name']; ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Data tidak tersedia</option>
            <?php endif; ?>
        </select>

        <br><br>
        <button type="submit">Pilih</button>
    </form>

    <!-- Menampilkan hasil pilihan -->
    <?php if (isset($_POST['provinsi']) && !empty($_POST['provinsi'])): ?>
        <h2>Provinsi yang dipilih:</h2>
        <p>ID Provinsi: <?= $_POST['provinsi']; ?></p>
    <?php endif; ?>
</body>

</html>