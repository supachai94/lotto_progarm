<?php
require_once './connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $keep3top = $_POST['keep3top'];
  $keep3down = $_POST['keep3down'];
  $keep3alternate = $_POST['keep3alternate'];
  $keep2top = $_POST['keep2top'];
  $keep2down = $_POST['keep2down'];

    //sql update
    $stmt = $conn->prepare("UPDATE  keep SET keep2top=:keep2top, keep2down=:keep2down, keep3top=:keep3top, keep3down=:keep3down, keep3alternate=:keep3alternate WHERE 1");
  
    $stmt->bindParam(':keep2top', $keep2top , PDO::PARAM_INT);
    $stmt->bindParam(':keep2down', $keep2down , PDO::PARAM_INT);
    $stmt->bindParam(':keep3top', $keep3top , PDO::PARAM_INT);
    $stmt->bindParam(':keep3down', $keep3down , PDO::PARAM_INT);
    $stmt->bindParam(':keep3alternate', $keep3alternate , PDO::PARAM_INT);
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
                  window.location = "main.php?page=keep"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 10);
        </script>';
    }else{
       echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  type: "error"
              }, function() {
                  window.location = "main.php?page=keep"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 10);
        </script>';
    }
    
} else {

}
//คิวรี่ข้อมูลมาแสดงในตาราง
$stmt = $conn->prepare("SELECT* FROM keep");
$stmt->execute();
$result = $stmt->fetchAll();

?>

<div class="card w-50 mx-auto">
  <h4 class="card-header text-center bg-light">ตั้งค่าตัดเก็บรายตัว</h4>
  <div class="card-body">
    <hr>
    <form method="post">
      <?php foreach($result as $x) {?>
        <div class="mb-3">
          <label class="form-label">สองตัวบน</label>
          <input type="text" class="form-control" value="<?= $x['keep2top'];?>" name="keep2top">
        </div>
        <div class="mb-3">
          <label class="form-label">สองตัวล่าง</label>
          <input type="text" class="form-control" value="<?= $x['keep2down'];?>" name="keep2down">
        </div>
        <div class="mb-3">
          <label class="form-label">สามตัวบน</label>
          <input type="text" class="form-control" value="<?= $x['keep3top'];?>" name="keep3top">
        </div>
        <div class="mb-3">
          <label class="form-label">สามตัวล่าง</label>
          <input type="text" class="form-control" value="<?= $x['keep3down'];?>" name="keep3down">
        </div>
        <div class="mb-3">
          <label class="form-label">สามตัวโต๊ด</label>
          <input type="text" class="form-control" value="<?= $x['keep3alternate'];?>" name="keep3alternate">
        </div>
      <?php } ?>
      <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">ยืนยัน</button>
      </div>
    </form>
  </div>
</div>


