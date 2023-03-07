<?php
if(isset($_POST['id'])){
    require_once 'connect.php';
    //ประกาศตัวแปรรับค่าจาก param method get
    $dealer_id = $_POST['id'];
    $stmt = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.amount, dealer.name, lottonumber.number FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE lottonumber.dealer_id LIKE $dealer_id;");
    $stmt->execute();
    
    //  sweet alert 
    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    
      if($stmt->rowCount() ==1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "index.php?page=dealer"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
        }else{
           echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "เกิดข้อผิดพลาด",
                      type: "error"
                  }, function() {
                      window.location = "index.php?page=dealer"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
        }
    $conn = null;
    } //isset

//ดึงขอมูลสามตัวล่าง
$down3 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.amount, dealer.name, lottonumber.number FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE lottonumber.dealer_id LIKE 7;
");
$down3->execute();
$result_down3 = $down3->fetchAll(); //แสดงข้อมูลทั้งหมด

?>
