<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .bg {
        background-color: #80BCBD;
    }

    .footer-social-icons a {
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .footer-social-icons a:hover {
        color: #aad9bb;
    }
</style>

<body>

    <footer class="bg text-white py-5">
        <div class="container">
            <div class="row">
                <!-- Logo and Description -->
                <div class="col-md-4 mb-4">
                    <h2 class="fw-bold">BersihinAja</h2>
                    <p class="small">
                        Leo elementum iaculis quam massa vitae odio sed. Morbi tincidunt senectus.
                    </p>
                    <div class="footer-social-icons">
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <!-- Navigation Links -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Navigation</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url('home'); ?>" class="text-white text-decoration-none d-block mb-2">Home</a></li>
                        <li><a href="<?php echo base_url('services'); ?>" class="text-white text-decoration-none d-block mb-2">Services</a></li>
                        <li><a href="<?php echo base_url('praregist'); ?>" class="text-white text-decoration-none d-block mb-2">Our Team</a></li>
                        <li><a href="<?php echo base_url('review'); ?>" class="text-white text-decoration-none d-block mb-2">Review</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2"></i>support@bersihina.com</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill me-2"></i>+62 812 3456 7890</li>
                        <li><i class="bi bi-geo-alt-fill me-2"></i>Jl. Kebersihan No. 10, Jakarta</li>
                    </ul>
                </div>
            </div>
            <hr class="border-white">
            <div class="text-center small">
                <p class="mb-0">Copyright © 2024 BersihinAja</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>