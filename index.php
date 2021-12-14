<?php

require 'setting.php';
require 'function.php';

if (!isset($_SESSION['users'])) {
  session_unset();
  session_destroy();
  header('location: login');
}

?>

<!doctype html>
   <html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- App favicon -->
      <link rel="shortcut icon" href="assets/images/favicon.ico">
      <!-- Bootstrap Css -->
      <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- DataTables -->
      <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <!-- Responsive datatable examples -->
      <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <!-- Plugins css -->
      <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

      <!-- App Css-->
      <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
   </head>
   <body data-topbar="dark" data-layout="horizontal">
      <!-- Begin page -->
      <div id="layout-wrapper">
         <header id="page-topbar">
            <div class="navbar-header">
               <div class="d-flex">
                  <!-- LOGO -->
                  <div class="navbar-brand-box">
                     <br>
                     <a href="index.php?page=dashboard">
                        <h2>
                           <font color="white">
                              Coo<font color="orange">pad. <i class="bx bx-book-open"></i></font>
                           </font>
                        </h2>
                     </a>
                  </div>
                  <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                     <i class="fa fa-fw fa-bars"></i>
                  </button>
                  <!-- App Search-->
                  <form class="app-search d-none d-lg-block">
                     <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                     </div>
                  </form>
               </div>
               <div class="d-flex">
                  <div class="dropdown d-inline-block d-lg-none ml-2">
                     <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                     data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="mdi mdi-magnify"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                  aria-labelledby="page-header-search-dropdown">
                  <form class="p-3">
                     <div class="form-group m-0">
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="Search ..." aria-label="Search input">
                           <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>s
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="dropdown d-inline-block">
               <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
               alt="Header Avatar">
               <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?= $_SESSION['users']['name'] ?></span>
               <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
               <!-- item-->
               <a class="dropdown-item" href="index.php?page=profile"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item text-danger" href="index.php?page=logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
            </div>
         </div>
      </div>
   </div>
</header>
</ul>
</div>
</nav>
</div>
</div>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- templating -->
         <?php  
         if (isset($_GET['page'])) {

           if ($_GET['page'] == "story") {
             include 'profile/cerita/index.php';
          } else if ($_GET['page'] == "add_story") {
             include 'profile/cerita/add.php';
          } else if ($_GET['page'] == "edit_story") {
             include 'profile/cerita/edit.php';
          } else if ($_GET['page'] == "dashboard") {
             include 'home.php';
          } else if ($_GET['page'] == "logout") {
             include 'login/logout.php';
          } else if ($_GET['page'] == "profile") {
             include 'profile/index.php';
          } else if ($_GET['page'] == "delete_story") {
             include 'profile/cerita/hapus.php';
          } else if ($_GET['page'] == "chapter") {
             include 'chapter/index.php';
          } else if ($_GET['page'] == "detail_story") {
             include 'profile/cerita/detail.php';
          } else if ($_GET['page'] == "add_chapter") {
             include 'profile/chapter/add.php';
          } else if ($_GET['page'] == "detail") {
             include 'cerita/index.php';
          } else if ($_GET['page'] == "chapter_detail") {
             include 'chapter/index.php';
          } else if ($_GET['page'] == "edit_chapter") {
             include 'profile/chapter/edit.php';
          } else if ($_GET['page'] == 'users') {
             include 'users/index.php';
          } else if ($_GET['page'] == 'add_users') {
             include 'users/add.php';
          } else if ($_GET['page'] == 'edit_users') {
             include 'users/edit.php';
          } else if ($_GET['page'] == 'detail_users') {
            include 'users/detail.php';
         } else if ($_GET['page'] == 'hapus_users') {
            include 'users/function/hapus.php';
         } else if ($_GET['page'] == 'profile_users') {
            include 'profile/profile.php';
         }


      } else {
        include 'home.php';
     }

     ?>
     <!-- end templating -->
  </div>
  <!-- container-fluid -->
</div>
<!-- End Page-content -->
<footer class="footer">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-6">
            <script>document.write(new Date().getFullYear())</script> © <?= $name_web ?>.
         </div>
         <div class="col-sm-6">
            <div class="text-sm-end d-none d-sm-block">
               Design & Develop by <?= $author ?>
            </div>
         </div>
      </div>
   </div>
</footer>
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard.init.js"></script>
<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>  

<script src="assets/ckeditor/ckeditor.js"></script> 

<!-- Plugins js -->
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>

<script src="assets/js/app.js"></script>
</body>
</html>