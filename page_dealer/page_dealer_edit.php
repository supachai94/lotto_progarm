<?php
session_start();
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
//เช็คว่ามีตัวแปร session อะไรบ้าง
//print_r($_SESSION);
//exit();
//สร้างเงื่อนไขตรวจสอบสิทธิ์การเข้าใช้งานจาก session
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
            echo '<script>
                setTimeout(function() {
                swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
                type: "error"
                }, function() {
                window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            exit();
}

if(isset($_GET['id'])){
require_once '../connect.php';
$stmt = $conn->prepare("SELECT* FROM dealer WHERE dealer_id=?");
$stmt->execute([$_GET['id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
if($stmt->rowCount() < 1){
    header('Location: index.php?page=dealer');
    exit();
}
}//isset
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>แก้ไขข้อมูลผู้ซื้อ/คนเดินโพย</title>
  </head>
  <body>
    <div class="card w-75 mx-auto m-5">
        <h4 class="card-header text-center bg-light">แก้ไขข้อมูลผู้ซื้อ/คนเดินโพย</h4>
        <div class="card-body">
            <hr>
            <form action="page_dealer_update.php" method="post">
                <div class="mb-2">
                <label for="name" class="col-sm-2 col-form-label"> ชื่อ :  </label>
                <div class="col-sm">
                    <input type="text" name="name" class="form-control" required value="<?= $row['name'];?>">
                </div>
                </div>
                <div class="mb-2">
                <label for="name" class="col-sm-2 col-form-label"> %ส่วนลด :  </label>
                <div class="col-sm">
                    <input type="text" name="discount" class="form-control" required value="<?= $row['discount'];?>">
                </div>
                </div>
                <input type="hidden" name="id" value="<?= $row['dealer_id'];?>">
                <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
                <a href="../main.php?page=dealer" class="btn btn-danger">ยกเลิก</a>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>