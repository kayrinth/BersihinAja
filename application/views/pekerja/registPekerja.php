<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f9f9f9;
        }

        .custom-btn {
            background-color: #89c6b6;
            border: none;
        }

        .custom-btn:hover {
            background-color: #76b3a4;
        }
    </style>
</head>

<body>
    <div class="text-center mb-4 d-flex align-items-center justify-content-center">
        <img src="/BersihinAja/assets/wind.svg" alt="Logo" width="50" height="50" class="me-2">
        <h2 class="text-bold m-0">BersihinAja</h2>
    </div>

    <div class="login-card col-md-4 bg-white rounded-2 shadow p-3">
        <div class="text-center mb-4">
            <h4 class="mt-3">Register Pekerja</h4>
        </div>
        <?= $this->session->flashdata('pesan_gagal'); ?>
        <form method="POST" action="<?php echo base_url('auth/registPekerja'); ?>" class="m-4">
            <div class="mb-3">
                <label for="Nama_User" class="form-label">Nama User</label>
                <input type="text" class="form-control" id="Nama_User" name="Nama_User" placeholder="Masukkan nama" required value="<?= set_value('Nama_User') ?>">
                <?php echo form_error('Nama_User', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="Email_User" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email_User" name="Email_User" placeholder="Masukkan email" required value="<?= set_value('Email_User') ?>">
                <?php echo form_error('Email_User', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="provinsi" class="form-label">Provinsi</label>
                <select class="form-select" id="provinsi" name="Provinsi" required>
                    <option value="">Pilih Provinsi</option>
                    <?php if (!empty($provinces)): ?>
                        <?php foreach ($provinces as $provinsi): ?>
                            <option value="<?= $provinsi['id']; ?>" <?= set_select('provinsi', $provinsi['id']); ?>>
                                <?= $provinsi['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <?php echo form_error('provinsi', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="kabupaten" class="form-label">Kabupaten</label>
                <select class="form-select" id="kabupaten" name="Kabupaten" required>
                    <option value="">Pilih kabupaten</option>
                </select>
                <?php echo form_error('kabupaten', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="No_Hp" class="form-label">No Telepon</label>
                <input type="number" class="form-control" id="No_Hp" name="No_Hp" placeholder="Masukkan Nomor Telepon" required value="<?= set_value('No_Hp') ?>">
                <?php echo form_error('No_Hp', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="KTP" class="form-label">KTP</label>
                <input type="number" class="form-control" id="KTP" name="KTP" placeholder="Masukkan KTP" required value="<?= set_value('KTP') ?>">
                <?php echo form_error('KTP', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    <span class="input-group-text" onclick="togglePassword()">
                        <i class="fa fa-eye" id="togglePasswordIcon"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="custom-btn btn text-white w-100 mb-3">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fungsi untuk toggle visibility password
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        $(document).ready(function() {
            $('#provinsi').on('change', function() {
                var provinsi_id = $(this).val();
                if (provinsi_id) {
                    $.ajax({
                        url: '<?php echo base_url('Auth/getKabupaten'); ?>',
                        type: 'POST',
                        data: {
                            provinsi_id: provinsi_id
                        },
                        success: function(response) {
                            try {
                                var kabupatenData = JSON.parse(response);
                                var kabupatenSelect = $('#kabupaten');
                                kabupatenSelect.empty();

                                if (kabupatenData.length > 0) {
                                    kabupatenSelect.append('<option value="">Pilih Kabupaten</option>');
                                    $.each(kabupatenData, function(index, kabupaten) {
                                        // Simpan ID kabupaten sebagai value
                                        kabupatenSelect.append('<option value="' + kabupaten.id + '">' +
                                            kabupaten.name + '</option>');
                                    });
                                } else {
                                    kabupatenSelect.append('<option value="">Tidak ada kabupaten</option>');
                                }
                            } catch (e) {
                                console.error("Error parsing JSON:", e);
                                console.log("Raw response:", response);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                            $('#kabupaten').empty()
                                .append('<option value="">Error loading kabupaten</option>');
                        }
                    });
                } else {
                    $('#kabupaten').empty()
                        .append('<option value="">Pilih kabupaten</option>');
                }
            });
        });
    </script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>

</html>