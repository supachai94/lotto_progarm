<div class="card w-50 mx-auto">
  <h4 class="card-header text-center bg-light">ใส่รหัสผ่านเพื่อลบข้อมูล</h4>
  <div class="card-body">
    <hr>
    <form method="post">
      <div class="form-group mb-4">
          <div class="input-group has-validation">
           <input type="hidden" value="admin" name="username" class="form-control" required minlength="3" placeholder="username">
        </div>
        <div class="col-sm-12 text-center">
          <input type="password" class="form-control w-50 mx-auto" id="password" name="password" placeholder="กรุณาใส่รหัสผ่าน" required>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-12 text-center">
          <button type="submit" name="update" class="btn btn-danger w-50"> ยืนยัน</button>
          <a class="nav-link active" aria-current="page" href="main.php?page=logout" onclick="return confirm('ยืนยันการลบข้อมูล');">
        </div>
      </div>
    </form>
  </div>
</div>



<?php


 if(isset($_POST['username']) && isset($_POST['password']) ){
    // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "229488"){

    //sql insert
    $stmt = $conn->prepare("DELETE FROM lottonumber");
    $result = $stmt->execute();

    $rs = $conn->prepare("ALTER TABLE lottonumber AUTO_INCREMENT = 1");
    $result_rs = $rs->execute();
    
     // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 
        if($result){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "main.php?page=report"; //หน้าที่ต้องการให้กระโดดไป
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
                      window.location = "main.php?page=report"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
        }

    }else{
        echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "รหัสผ่านไม่ถูกต้อง",
                      type: "error"
                  }, function() {
                      window.location = "main.php?page=destroy"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';

    }
    
    $conn = null; //close connect db
    }

     //isset
?>