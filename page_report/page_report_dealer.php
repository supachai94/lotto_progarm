<?php
require_once '../connect.php';

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
$id = $_GET['id'];
$getdata = $conn->query("SELECT typelotto, number, SUM(amount) AS amount, dealer_id FROM `lottonumber` WHERE dealer_id = $id GROUP BY typelotto, number ORDER BY typelotto DESC;")->fetchAll();
$getdata_dealer = $conn->query("SELECT * FROM `dealer` WHERE `dealer_id` = $id")->fetchAll();
$name = $getdata_dealer[0][1];
$discount = $getdata_dealer[0][2];
$data_array = array();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>รายการซื้อหวยของ คุณ<?php echo $name ?></title>
  </head>
  <body>
  <div class="card text-center w-75 mx-auto m-5">
    <div class="card-header">
        <h4>รายการซื้อหวยของ คุณ<?php echo $name ?></h4>
    </div>
    <div class="card-body">
    <div class="table-responsive">   
        <table class="table table-bordered border-info table-info table-striped table-hover text-center">
            <thead class="table bg-info bg-gradient border-info text-dark">
                <tr>
                    <th scope="col">ประเภทหวย</th>
                    <th scope="col">ตัวเลข</th>
                    <th scope="col">จำนวนเงิน</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php foreach($getdata as $k): ?>
                        <?php 
                            $X = $k['typelotto'];
                            if ($X == "CA") {
                                $X = "สองตัวบน";
                            } elseif ($X == "CB") {
                                $X = "สองตัวล่าง";
                            } elseif ($X == "AB") {
                                $X = "สามตัวบน";
                            } elseif ($X == "AC") {
                                $X = "สามตัวล่าง"; 
                            } elseif ($X == "AD") {
                                $X = "สามตัวโต๊ด"; 
                            } elseif ($X == "XA") {
                                $X = "สามประตูบน";
                            } elseif ($X == "XB") {
                                $X = "สามประตูล่าง";
                            } elseif ($X == "XC") {
                                $X = "หกประตูบน";
                            } elseif ($X == "XD") {
                                $X = "หกประตูล่าง"; 
                            }else {
                                $X = "";
                            }
                        ?>
                    <td scope="row"><?= $X ;?></td>
                    <td><?= $k['number'];?></td>
                    <td><?= $k['amount'];?></td>
                    <?php 
                    array_push($data_array,$k['amount']);
                    $total_all = array_sum($data_array);
                    ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="row" colspan="2">รวมก่อนหักส่วนลด</th>
                    <td><b><?php echo number_format( $total_all, 0 ); ?> บาท</b></td>
                </tr>
                <tr>
                    <th scope="row" colspan="2">รวมหลังหักส่วนลด <?php echo $discount ?>%</th>
                    <td><b><?php echo number_format( ($total_all-(($total_all*$discount)/100)), 0 ); ?> บาท</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>