<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - BersihinAja</title>
    <!-- Bootstrap CSS -->
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
        <img src="/user/assets/wind.svg" alt="Logo" width="50" height="50" class="me-2">
        <h2 class="text-bold m-0">BersihinAja</h2>
    </div>

    <div class="login-card col-md-4 bg-white rounded-2 shadow p-3">
        <div class="text-center mb-4">
            <h4 class="mt-3">Sign in as Admin</h4>
        </div>

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Email" value="<?php echo set_value('username') ?>">
                <span class="text-danger small">
                    <?php echo form_error("username"); ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="<?php echo set_value("password") ?>">
                <span class="text-danger small">
                    <?php echo form_error("password"); ?>
                </span>
            </div>
            <button type="submit" class="btn custom-btn w-100 mb-3 text-white">Log in</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<?php if ($this->session->flashdata('pesan_sukses')): ?>
	<script>swal("Sukses!", "<?php echo $this->session->flashdata('pesan_sukses') ?>", "success");</script>
	<?php endif ?>

	<?php if ($this->session->flashdata('pesan_gagal')): ?>
	<script>swal("Gagal Login!", "<?php echo $this->session->flashdata('pesan_gagal') ?>", "error");</script>
	<?php endif ?>
</body>

</html>
