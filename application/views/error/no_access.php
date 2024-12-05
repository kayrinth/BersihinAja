<div class="container mt-5">
    <div class="alert alert-danger">
        <h4>Akses Ditolak</h4>
        <p><?= $message; ?></p>
        <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-primary">Log out</a>
    </div>
</div>
