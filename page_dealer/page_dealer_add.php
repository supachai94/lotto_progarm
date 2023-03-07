<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
    if(isset($_POST['name']) && isset($_POST['discount'])){
    //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $name = $_POST['name'];
    $discount = $_POST['discount'];
    //sql insert
    $stmt = $conn->prepare("INSERT INTO dealer (name, discount) VALUES (:name, :discount)");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':discount', $discount , PDO::PARAM_STR);
    $result = $stmt->execute();
     // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 
    if($result){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "main.php?page=dealer"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "main.php?page=dealer"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
    $conn = null; //close connect db
    } //isset
?>

<div class="card w-50 mx-auto">
  <h4 class="card-header text-center bg-light">เพิ่มข้อมูลผู้ซื้อ/คนเดินโพย</h4>
  <div class="card-body">
    <hr>
    <form method="post">
        <div class="mb-1">
            <label for="name" class="col-sm col-form-label"> ชื่อ - นามสกุล</label>
            <div class="col-sm">
                <input type="text" name="name" class="form-control" placeholder="ใส่ข้อมูลผู้ซื้อ">
            </div>
        </div>
        <div class="mb-1">
            <label for="name" class="col-sm col-form-label"> % ส่วนลด</label>
            <div class="col-sm">
                <input type="text" name="discount" class="form-control" placeholder="ใส่ข้อมูลส่วนลด">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
    </form>
  </div>
</div>

