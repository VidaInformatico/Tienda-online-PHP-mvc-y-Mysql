<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE_URL; ?>assets/images/logo.png">
  <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>assets/images/logo.png">
  <title>
    Tienda | Online
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="<?php echo BASE_URL; ?>assets/admin/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?php echo BASE_URL; ?>assets/admin/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="<?php echo BASE_URL; ?>assets/admin/css/material-dashboard.css" rel="stylesheet" />
  <link id="pagestyle" href="<?php echo BASE_URL; ?>assets/admin/css/dropzone.css" rel="stylesheet" />
  <link id="pagestyle" href="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?php echo BASE_URL; ?>" target="_blank">
        <img src="<?php echo BASE_URL; ?>assets/images/logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Tienda</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($data['title'] == 'administracion') ? 'active bg-gradient-primary' : ''; ?>" href="<?php echo BASE_URL . 'admin/home'; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($data['title'] == 'usuarios') ? 'active bg-gradient-primary' : ''; ?>" href="<?php echo BASE_URL . 'usuarios'; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Usuarios</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($data['title'] == 'categorias') ? 'active bg-gradient-primary' : ''; ?>" href="<?php echo BASE_URL . 'categorias'; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">sell</i>
            </div>
            <span class="nav-link-text ms-1">Categorias</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($data['title'] == 'productos') ? 'active bg-gradient-primary' : ''; ?>" href="<?php echo BASE_URL . 'productos'; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Productos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($data['title'] == 'pedidos') ? 'active bg-gradient-primary' : ''; ?>" href="<?php echo BASE_URL . 'pedidos'; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">fact_check
              </i>
            </div>
            <span class="nav-link-text ms-1">Pedidos</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <ul class="navbar-nav  justify-content-end ms-md-auto">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?php echo BASE_URL; ?>assets/admin/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="<?php echo BASE_URL . 'admin/salir'; ?>" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Cerrar sesión</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">