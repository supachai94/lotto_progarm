<div class="card w-50 mx-auto">
  <h4 class="card-header text-center bg-light">เปลี่ยนรหัสผ่าน</h4>
  <div class="card-body">
    <hr>
    <form method="post">
      <div class="form-group mb-4">
        <div class="col-sm-12 text-center">
          <input type="password" class="form-control w-50 mx-auto" id="password" name="password" placeholder="ใส่รหัสผ่านใหม่" required>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-12 text-center">
          <button type="submit" name="update" class="btn btn-primary w-50">ยืนยัน</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php 
    require './connect.php';
    if (isset($_POST['update'])){
        $username = 'admin';
        $password = $_POST['password'];

        $sql =  $conn->prepare("UPDATE user SET username = :username , password = :password WHERE username = :username");
        $sql->bindParam(":username", $username);
        $sql->bindParam(":password", $password);
        $sql->execute();

        if($sql->rowCount() >= 0){
          echo '<script>
               setTimeout(function() {
                swal({
                    title: "แก้ไขข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "main.php?page=logout"; //หน้าที่ต้องการให้กระโดดไป
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
                    window.location = "main.php?page=change_password"; //หน้าที่ต้องการให้กระโดดไป
                });
              }, 10);
          </script>';
      }
      $conn = null; //close connect db
    }
?>