<?php include("./page_report/page_report_header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-danger">
                    <td colspan="2">ตัดส่งสามตัวบน</td>
                </tr>
                <tr class="table-danger">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $keep = $conn->prepare("SELECT `keep3top`, `keep3down`, `keep3alternate` FROM `keep` WHERE 1");
                    $keep->execute();
                    $keepdata = $keep->fetchAll();
                    $top_3send = $keepdata[0][0];
                    $down_3send = $keepdata[0][1];
                    $alternate_3send = $keepdata[0][2];

                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AB') GROUP BY number HAVING amount > $top_3send;");
                    $top->execute();
                    $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $data_array = array();
                ?>
                <?php foreach($result_top as $rows) {?>
                    <?php 
                        $r = $rows["amount"];
                            $x = $r-$top_3send;
                        
                        array_push($data_array,$x);
                        $total_top3_send = array_sum($data_array);
                    ?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $x, 0 ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                    <tr class="table-danger">
                        <td><b>รวมทั้งหมด</b></td>
                        <?php
                        if (empty($total_top3_send)) {
                            $show_total_top3 = '0';                            
                            } else {
                            $show_total_top3 = $total_top3_send;
                            }
                        ?>
                        <td><b><?php echo number_format( $show_total_top3, 0 ); ?> บาท</b></td>
                    </tr>
            </tfoot>
            </table>
        </div>
    </div>
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-danger">
                    <td colspan="2">ตัดส่งสามตัวล่าง</td>
                </tr>
                <tr class="table-danger">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AC') GROUP BY number HAVING amount > $down_3send;");
                    $top->execute();
                    $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $data_array = array();
                ?>
                <?php foreach($result_top as $rows) {?>
                    <?php 
                        $r = $rows["amount"];
                            $x = $r-$down_3send;
                            
                        array_push($data_array,$x);
                        $total_down3_send = array_sum($data_array);
                    ?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $x, 0 ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                    <tr class="table-danger">
                        <td><b>รวมทั้งหมด</b></td>
                        <?php
                        if (empty($total_down3_send)) {
                            $show_total_down3 = '0';                            
                            } else {
                            $show_total_down3 = $total_down3_send;
                            }
                        ?>
                        <td><b><?php echo number_format( $show_total_down3, 0 ); ?> บาท</b></td>
                    </tr>
            </tfoot>
            </table>
        </div>
    </div>
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-danger">
                    <td colspan="2">ตัดส่งสามตัวโต๊ด</td>
                </tr>
                <tr class="table-danger">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AD','XA','XB','XC','XD') GROUP BY number HAVING amount > $alternate_3send;");
                    $top->execute();
                    $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $data_array = array();
                ?>
                <?php foreach($result_top as $rows) {?>
                    <?php 
                        $r = $rows["amount"];
                            $x = $r-$alternate_3send;
                        
                        array_push($data_array,$x);
                        $total_rv3_keep = array_sum($data_array);
                    ?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $x, 0 ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                    <tr class="table-danger">
                        <td><b>รวมทั้งหมด</b></td>
                        <?php
                        if (empty($total_rv3_keep)) {
                            $show_total_rv3 = '0';                            
                            } else {
                            $show_total_rv3 = $total_rv3_keep;
                            }
                        ?>
                        <td><b><?php echo number_format( $show_total_rv3, 0 ); ?> บาท</b></td>
                    </tr>
            </tfoot>
            </table>
        </div>
    </div>
  </div>
</div>
<div class="no-print">
<?php include("./page_report/page_report_foot.php"); ?>
</div>