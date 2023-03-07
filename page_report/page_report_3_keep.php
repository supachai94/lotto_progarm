<?php include("./page_report/page_report_header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-success">
                    <td colspan="2">ตัดเก็บสามตัวบน</td>
                </tr>
                <tr class="table-success">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $keep = $conn->prepare("SELECT `keep3top`, `keep3down`, `keep3alternate` FROM `keep` WHERE 1");
                    $keep->execute();
                    $keepdata = $keep->fetchAll();
                    $top_3keep = $keepdata[0][0];
                    $down_3keep = $keepdata[0][1];
                    $alternate_3keep = $keepdata[0][2];

                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AB') GROUP BY number;");
                    $top->execute();
                    $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $data_array = array();
                ?>
                <?php foreach($result_top as $rows) {?>
                    <?php 
                        $r = $rows["amount"];
                        if ($r <= $top_3keep) {
                            $x = $r;
                        } else {
                            $x = $top_3keep;
                        }
                        array_push($data_array,$x);
                        $total_top3_keep = array_sum($data_array);
                    ?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $x, 0 ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php { ?>
                    <tr class="table-success">
                        <td><b>รวมทั้งหมด</b></td>
                        <?php
                        if (empty($total_top3_keep)) {
                            $show_total_top3 = '0';                            
                            } else {
                            $show_total_top3 = $total_top3_keep;
                            }
                        ?>
                        <td><b><?php echo number_format( $show_total_top3, 0 ); ?> บาท</b></td>
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
                <tr class="table-success">
                    <td colspan="2">ตัดเก็บสามตัวล่าง</td>
                </tr>
                <tr class="table-success">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AC') GROUP BY number;");
                    $top->execute();
                    $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $data_array = array();
                ?>
                <?php foreach($result_top as $rows) {?>
                    <?php 
                        $r = $rows["amount"];
                        if ($r <= $down_3keep) {
                            $x = $r;
                        } else {
                            $x = $down_3keep;
                        }
                        array_push($data_array,$x);
                        $total_down3_keep = array_sum($data_array);
                    ?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $x, 0 ); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php { ?>
                    <tr class="table-success">
                        <td><b>รวมทั้งหมด</b></td>
                        <?php
                        if (empty($total_down3_keep)) {
                            $show_total_down3 = '0';                            
                            } else {
                            $show_total_down3 = $total_top3_keep;
                            }
                        ?>
                        <td><b><?php echo number_format( $show_total_down3, 0 ); ?> บาท</b></td>
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
                <tr class="table-success">
                    <td colspan="2">ตัดเก็บสามตัวโต๊ด</td>
                </tr>
                <tr class="table-success">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //ไฟล์เชื่อมต่อฐานข้อมูล
                    //query data
                    $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('AD','XA','XB','XC','XD') GROUP BY number;");
                    $top->execute();
                    $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $data_array = array();
                ?>
                <?php foreach($result_top as $rows) {?>
                    <?php 
                        $r = $rows["amount"];
                        if ($r <= $alternate_3keep) {
                            $x = $r;
                        } else {
                            $x = $alternate_3keep;
                        }
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
                <?php { ?>
                    <tr class="table-success">
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
                <?php } ?>
            </tfoot>
            </table>
        </div>
    </div>
  </div>
</div>
