<?php include("./page_report/page_report_header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col">        
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-info">
                    <td colspan="2">สองตัวบน</td>
                </tr>
                <tr class="table-info">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                //ไฟล์เชื่อมต่อฐานข้อมูล
                //query data
                $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CA') GROUP BY number;");
                $top->execute();
                $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด
                ?>
                <?php foreach($result_top as $rows) {?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $rows["amount"], 0 ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $total = $conn->prepare("SELECT SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CA');");
                    $total->execute();
                    $result_total = $total->fetchAll(); //แสดงข้อมูลทั้งหมด
                    //var_dump($result_total);
                ?>
                <?php { ?>
                    <tr class="table-success">
                        <td><b>รวมทั้งหมด</b></td>
                        <td><b><?php echo number_format( $result_total[0][0], 0 ); ?> บาท</b></td>
                    </tr>
                <?php } ?>
            </tfoot>
            </table>
        </div>
    </div>
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-info">
                    <td colspan="2">สองตัวล่าง</td>
                </tr>
                <tr class="table-info">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $down = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CB') GROUP BY number;");
                    $down->execute();
                    $result_down = $down->fetchAll(); //แสดงข้อมูลทั้งหมด
                ?>
                <?php foreach($result_down as $rows) {?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $rows["amount"], 0 ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $total = $conn->prepare("SELECT SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CB');");
                    $total->execute();
                    $result_total = $total->fetchAll(); //แสดงข้อมูลทั้งหมด
                    //var_dump($result_total);
                ?>
                <?php { ?>
                    <tr class="table-success">
                        <td><b>รวมทั้งหมด</b></td>
                        <td><b><?php echo number_format( $result_total[0][0], 0 ); ?> บาท</b></td>
                    </tr>
                <?php } ?>
            </tfoot>
            </table>
        </div>
    </div>
  </div>
</div>
<?php include("./page_report/page_report_foot.php"); ?>