<?php
require_once 'function_keydata.php';

// ใช้ค่าอินพุตก่อนหน้า หรือตั้งค่าเริ่มต้นหากไม่มีอยู่
$select_dealer_special      = isset($_SESSION['last_select_dealer'])        ? $_SESSION['last_select_dealer'] : '';          
$select_lotto_type  = isset($_SESSION['last_select_lotto_type'])    ? $_SESSION['last_select_lotto_type'] : '';          
$amount             = isset($_SESSION['last_amount'])               ? $_SESSION['last_amount'] : '';           
$number             = isset($_SESSION['last_number'])               ? $_SESSION['last_number'] : '';           
    
//คิวรี่ข้อมูลมาแสดงในตาราง
require './connect.php';
$stmt = $conn->prepare("SELECT* FROM dealer");
$stmt->execute();
$result = $stmt->fetchAll();

if (empty($select_dealer_special)) {
    $D_id = '0';
    $D_name = '--เลือก--';
} else {
    $dealer = $conn->prepare("SELECT name FROM dealer WHERE `dealer_id` = $select_dealer_special");
    $dealer->execute();
    $result_id = $dealer->fetchAll();
    if ($dealer->rowCount() == 0) {
        $D_id = '0';
        $D_name = '--เลือก--';
      } else {
        $D_id = $select_dealer_special;
        $D_name = $result_id[0][0];
      }
}


if (empty($select_lotto_type)) {
    $type_id = "0";
    $type_name = "--เลือก--";
}elseif($select_lotto_type == "1") {
    $type_id = "1";
    $type_name = "3 ประตู";
}elseif($select_lotto_type == "2") {
    $type_id = "2";
    $type_name = "6 ประตู";
} else {
    $type_id = "0";
    $type_name = "--เลือก--00";
}

?>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<div class="card w-100 mx-auto">
  <h4 class="card-header text-center bg-light">เลขพิเศษ</h4>
  <div class="card-body">
    <hr>
<nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center btn btn-success  active" aria-current="page" href="main.php?page=keydata_normal"><b>เลขตรง เลขโต๊ด</a></b>&nbsp;&nbsp;
  <a class="flex-sm-fill text-sm-center btn btn-warning active" aria-current="page" href="main.php?page=keydata_special"><b>เลขพิเศษ</a></b>
</nav><br>
<?php
$num_empty = isset($_SESSION['num_empty'])    ? $_SESSION['num_empty'] : '';
if (empty($num_empty)) {
  # code...
} else {
  echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
          <div>
            '.$num_empty.'
          </div>
        </div>';
  unset($_SESSION['num_empty']);
}

$dealer_empty = isset($_SESSION['dealer_empty'])    ? $_SESSION['dealer_empty'] : '';
if (empty($dealer_empty)) {
  # code...
} else {
  echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
          <div>
            '.$dealer_empty.'
          </div>
        </div>';
  unset($_SESSION['dealer_empty']);
}

$amount_empty = isset($_SESSION['amount_empty'])    ? $_SESSION['amount_empty'] : '';
if (empty($amount_empty)) {
  # code...
} else {
  echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
          <div>
            '.$amount_empty.'
          </div>
        </div>';
  unset($_SESSION['amount_empty']);
}

$save_empty = isset($_SESSION['save_empty'])    ? $_SESSION['save_empty'] : '';
if (empty($save_empty)) {
  # code...
} else {
  echo '<div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
          <div>
            '.$save_empty.'
          </div>
        </div>';
  unset($_SESSION['save_empty']);
}

$check_num_type = isset($_SESSION['check_num_type'])    ? $_SESSION['check_num_type'] : '';
if (empty($check_num_type)) {
  # code...
} else {
  echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
          <div>
            '.$check_num_type.'
          </div>
        </div>';
  unset($_SESSION['check_num_type']);
}


?>
    <form method="post" action="./page_keydata/getdatatodb_special.php" onSubmit="return preventMultipleSubmit();">
        <div class="row mb">
        <label for="select_dealer_special" class="col-sm-4 col-form-label text-end"><b>ผู้ซื้อ/คนเดินโพย</label></b>
        <div class="col-sm">
            <select name="select_dealer_special" class="form-select form-select-lg mb-2 text-center" aria-label=".form-select-lg example">
            <option value="<?php echo $D_id ?>" selected><?php echo $D_name ?></option>
            <?php foreach($result as $k) {?>
            <option value="<?= $k['dealer_id'];?>"><?= $k['name'];?></option>
            <?php } ?>
            </select>
        </div>
        </div>

        <div class="row mb-2">
        <label for="select_lotto_type" class="col-sm-4 col-form-label text-end"><b>ประเภทเลขพิเศษ</label></b>
        <div class="col-sm">
            <select name="select_lotto_type" class="form-select form-select-lg mb-2 text-center" aria-label=".form-select-lg example">
            <option value="<?= $type_id ?>" selected><?= $type_name ?></option>
            <option value="2">6 ประตู</option>
            <option value="1">3 ประตู</option>
            </select>
        </div>
        </div><br>
        
        <div class="col-sm" align="center">
            <input type="checkbox" id="checkbox1" name="top" value="TP" checked>
            <label for="checkbox1"><b>บน</label></b>&nbsp;&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; 
       
            <input type="checkbox" id="checkbox2" name="down" value="DW">
            <label for="checkbox2"><b>ล่าง</label></b>
        </div> <br>


        <div class="row mb-2">
        <label for="number" class="col-sm-4 col-form-label text-end"><b>ตัวเลข</label></b>
        <div class="col-sm">
            <input type="number" class="form-control" name="number" id="no1" minlength="2" maxlength="3" autofocus onkeydown="return nextbox(event, 'no2')"/>
        </div>

        </div>
        <div class="row mb-3">
        <label for="amount" class="col-sm-4 col-form-label text-end"><b>จำนวนเงิน</label></b>
        <div class="col-sm">
            <input type="number" OnClick="this.select();" value="<?php echo $amount; ?>" class="form-control" name="amount" id="no2" onkeydown="return nextbox(event, 'no3')"/>
        </div>
        </div>

        <center><button type="submit" class="btn btn-warning" name="data_special"><b>ยืนยัน</button></center></b>
    </form>
  </div>
</div>
</div>

<script type="text/javascript">
function nextbox(e, id) {
   // อ่าน keycode (cross browser)
    var keycode = e.which || e.keyCode;
    var x = document.getElementById("no1").value;
    // ตรวจสอบ keycode (13 คือ กด enter)
    if (keycode == 13) {
          if (x ==='') {
            document.getElementById("no1").select();
            // return false เพื่อยกเลิกการ submit form
            return false;
          } else {
            // ย้ายโฟกัสไปยัง input ที่ id
            document.getElementById(id).select();
            // return false เพื่อยกเลิกการ submit form
            return false;
          }
    }
}

var formSubmitted = false; //ตัวแปรสำหรับตรวจสอบการส่งฟอร์ม
var formSubmitting = false; //ตัวแปรสำหรับตรวจสอบการส่งฟอร์ม

function preventMultipleSubmit() {
    if (!formSubmitting && !formSubmitted) { //ตรวจสอบว่าฟอร์มอยู่ในกระบวนการส่งหรือไม่
        formSubmitting = true;
        return true;
    } else {
        return false;
    }
}

window.onload = function() {
    formSubmitting = false;
};
</script>
  
  
  


