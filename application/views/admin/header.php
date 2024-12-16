<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="//<?php echo $_SERVER['HTTP_HOST'] . '/assets/css/admin.css'; ?>" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
  crossorigin="anonymous"></script>
  
    
</head>

<body>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
        <a href="<?php echo base_url("admin/home") ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
          <i class="fas fa-house fa-fw me-3">
          </i><span>Home</span>
        </a>
        
        <a href="<?php echo base_url("admin/layanan") ?>" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fas fa-list-check fa-fw me-3">
          </i><span>Services</span>
        </a>

        <a href="<?php echo base_url("admin/transaksi") ?>" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-hand-holding-dollar fa-fw me-3">
          </i><span>Transactions</span>
        </a>

        <a href="<?php echo base_url("admin/customer") ?>" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-user fa-fw me-3">
          </i><span>Customers</span>
        </a>

        <a href="<?php echo base_url("admin/pekerja") ?>" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-user-tie fa-fw me-3">
          </i><span>Workers</span>
        </a>

        </div>
      </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <span class="text-2xl font-bold text-gray-800 flex items-center">
            <img src="<?php echo base_url('/assets/image/wind.svg'); ?>" alt="logo" class="h-6 mr-2">
            BersihinAja
          </span>
          
        </a>
        <!-- Search form -->
        <form class="d-none d-md-flex input-group w-auto my-auto">
          <input autocomplete="off" type="search" class="form-control rounded"
            placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
          <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
        </form>
        <!-- Search form -->

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
              role="button" data-mdb-dropdown-init aria-expanded="false">
              <i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Some news</a></li>
              <li><a class="dropdown-item" href="#">Another news</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else</a>
              </li>
            </ul>
          </li>
          <!-- Notification dropdown -->

          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
              <?php echo $this->session->userdata("Nama_User") ?>   
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="<?php echo base_url("admin/akun") ?>">My profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url("admin/logout") ?>">Logout</a></li>
            </ul>
          </li>
          <!-- Avatar -->

        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main >
    <div class="container pt-4">
        <!-- Section: Dynamic Content -->

        <!-- Section: Dynamic Content -->
    </div>
  </main>
  <!--Main layout-->
  <!-- MDB -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>
  <script src="//<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/admin.js"></script>


</body>

</html>