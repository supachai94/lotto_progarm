<?php
require_once '../connect.php';
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['name']) && isset($_POST['discount']) && isset($_POST['id'])) {
    //ไฟล์เชื่อมต่อฐานข้อมูล
//ประกาศตัวแปรรับค่าจากฟอร์ม
$id = $_POST['id'];
$name = $_POST['name'];
$discount = $_POST['discount'];
//sql update
$stmt = $conn->prepare("UPDATE dealer SET name=:name, discount=:discount WHERE dealer_id=:dealer_id");
$stmt->bindParam(':dealer_id', $id , PDO::PARAM_INT);
$stmt->bindParam(':name', $name , PDO::PARAM_STR);
$stmt->bindParam(':discount', $discount , PDO::PARAM_STR);
$stmt->execute();

// sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

 if($stmt->rowCount() >= 0){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "แก้ไขข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "../main.php?page=dealer"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "../main.php?page=dealer"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>