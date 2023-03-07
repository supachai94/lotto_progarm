<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ระบบจัดเก็บข้อมูลหวย</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo2.png" rel="icon">
  <link href="assets/img/logo1.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

   <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div> 
    <!-- End Logo -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="main.php?page=report">
          <i class="bi bi-grid"></i>
          <span>สรุปยอดหวย</span>
        </a>
      </li><!-- End สรุปยอดหวย -->

      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="main.php?page=keydata">
          <i class="bi bi-journal-text"></i><span>คีย์ข้อมูลหวย</span>
        </a>
      
      </li><!-- End คีย์ข้อมูลหวย -->

      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="main.php?page=keep">
          <i class="bi bi-pencil-square"></i><span>ตั้งค่าตัดเก็บรายตัว</span>
        </a>
        
      </li><!-- End ตั้งค่าตัดเก็บรายตัว -->

      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="main.php?page=dealer">
          <i class="bi bi-people"></i><span>ผู้ซื้อ/คนเดินโพยหวย</span>
        </a>
       
      </li><!-- End ผู้ซื้อ/คนเดินโพยหวย -->

      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="main.php?page=checklotto">
          <i class="bi bi-search"></i> <span>ตรวจหวย</span>
        </a>
   
      </li><!-- End ตรวจหวย -->

        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="main.php?page=destroy">
          <i class="bi bi-trash3"></i> <span>ล้างข้อมูลหวยทั้งหมด</span>
        </a>
   
      </li><!-- End ลบข้อมูลทั้งหมดดด-->


      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="main.php?page=change_password">
          <i class="bi bi-person"></i>
          <span>เปลี่ยนรหัสผ่าน</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="main.php?page=logout" onclick="return confirm('ยืนยันการออกจากระบบ');">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>ออกจากระบบ</span>
        </a>
      </li>
      
    </ul>

  </aside><!-- End Sidebar-->
  
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>