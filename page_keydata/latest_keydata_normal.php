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
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $total_rv = $conn->prepare("SELECT SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AD','XA','XB','XC','XD');");
                    $total_rv->execute();
                    $result_total_rv = $total_rv->fetchAll(); //แสดงข้อมูลทั้งหมด

                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $total_down = $conn->prepare("SELECT SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AC');");
                    $total_down->execute();
                    $result_total_down = $total_down->fetchAll(); //แสดงข้อมูลทั้งหมด

                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $total_top = $conn->prepare("SELECT SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AB');");
                    $total_top->execute();
                    $result_total_top = $total_top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $total_2down = $conn->prepare("SELECT SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CB');");
                    $total_2down->execute();
                    $result_total_2down = $total_2down->fetchAll(); //แสดงข้อมูลทั้งหมด

                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $total_2top = $conn->prepare("SELECT SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CA');");
                    $total_2top->execute();
                    $result_total_2top = $total_2top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $top2 = (int)$result_total_2top[0][0];
                    $down2 = (int)$result_total_2down[0][0];
                    $top3 = (int)$result_total_top[0][0];
                    $down3 = (int)$result_total_down[0][0];
                    $rv3 = (int)$result_total_rv[0][0];
                    
                    $total_all = $top2+$down2+$top3+$down3+$rv3  
                ?>
                <td colspan="5" class="table bg-warning bg-gradient border-success"><b>ยอดรวมทั้งหมด <?php echo number_format( $total_all, 0 ); ?> บาท</b></td>
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


