<?php
require_once './connect.php';
//ไฟล์เชื่อมต่อฐานข้อมูล
if (isset($_POST['select_dealer'])) {
    // รับค่าอินพุตจากข้อมูลในแบบฟอร์ม
    $dealer_id      = $_POST['select_dealer'];
} else {
    // ใช้ค่าอินพุตก่อนหน้า หรือตั้งค่าเริ่มต้นหากไม่มีอยู่
    $dealer_id      = isset($_SESSION['last_select_dealer'])    ? $_SESSION['last_select_dealer'] : '';
  }
$_SESSION['last_select_dealer'] = $dealer_id;

$stmt = $conn->prepare("SELECT* FROM dealer");
$stmt->execute();
$result = $stmt->fetchAll();

if (empty($dealer_id)) {
    $D_id = '0';
    $D_name = '--เลือก--';
} else {
    $dealer = $conn->prepare("SELECT name FROM dealer WHERE `dealer_id` = $dealer_id");
    $dealer->execute();
    $result_id = $dealer->fetchAll();
    if ($dealer->rowCount() == 0) {
      $D_id = '0';
      $D_name = '--เลือก--';
    } else {
      $D_id = $dealer_id;
      $D_name = $result_id[0][0];
    }
}
?>

<div>
    <div class="row mb-2">
        <form method="post">
            <div class="row mb-2">
                <div class="col-sm">
                <select name="select_dealer" onchange="this.form.submit()" class="form-select form-select-lg mb text-center" aria-label=".form-select-lg example">
                    <option value="<?= $D_id; ?>" selected><?= $D_name; ?></option>
                    <?php foreach ($result as $k) { ?>
                    <option value="<?= $k['dealer_id']; ?>"><?= $k['name']; ?></option>
                    <?php } ?>
                </select>
                </div>
            </div> 

        </form>
    </div>
</div>
