<?php 
  // Database
  require_once './connect.php';
  
  $getdata = $conn->query("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.date, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto IN ('CA', 'CB', 'AB', 'AC', 'AD') ORDER BY date DESC LIMIT 0, 10;")->fetchAll();
?>

<div class="card w-100 mx-auto">
  <h4 class="card-header text-center bg-light">รายการคีย์ล่าสุด</h4>
  <div class="card-body">
    <hr>
        <!-- Datatable -->
        <div class="table-responsive">
        <table class="table table-bordered border-success table-success table-striped table-hover text-center">
            <thead class="table bg-success bg-gradient border-success text-white">
                <tr>
                    <th scope="col">ประเภทหวย</th>
                    <th scope="col">ตัวเลข</th>
                    <th scope="col">จำนวนเงิน</th>
                    <th scope="col">ผู้ซื้อ</th>
                    <th scope="col">วันที่</th>
                </tr>
            </thead>
            <tbody>
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
                          }else {
                            $X = "";
                          }
                    ?>
                <tr>
                    <td scope="row"><?= $X ;?></td>
                    <td><?= $k['number'];?></td>
                    <td><?= $k['amount'];?></td>
                    <td><?= $k['name'];?></td>
                    <td><?= $k['date'];?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <div class="d-grid gap-2">
          <a class="btn btn-success"  href="main.php?page=keydata_all">ดูข้อมูลทั้งหมด</a>
        </div>
  </div>
</div>


