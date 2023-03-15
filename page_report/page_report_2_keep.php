<?php include("./page_report/page_report_header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col">        
        <div class="table-responsive">
            <table id="table1" class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-success">
                    <td colspan="2">ตัดเก็บสองตัวบน</td>
                </tr>
                <tr class="table-success">
                    <td>ตัวเลข</td>
                    <td>จำนวนเงิน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $keep = $conn->prepare("SELECT `keep2top`, `keep2down`FROM `keep` WHERE 1;");
                $keep->execute();
                $keepdata = $keep->fetchAll();
                $top_keep = $keepdata[0][0];
                $down_keep = $keepdata[0][1];

                $top = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CA') GROUP BY number");
                $top->execute();
                $result_top = $top->fetchAll(); //แสดงข้อมูลทั้งหมด

                $data_array = array();
                ?>

                <?php foreach($result_top as $rows) {?>
                    <?php                    
                        (int)$r = $rows["amount"];
                        if ($r > $top_keep){
                            $x = ($r + $top_keep) - $r;
                        } else{
                            $x = (int)$r;
                        };
                        array_push($data_array,$x);
                        $total_top_keep = array_sum($data_array);
                        
                    ?>
                    <tr>
                        <td><?php echo $rows["number"]; ?></td>
                        <td><?php echo number_format( $x, 0 );?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                    <tr class="table-success">
                        <td><b>รวมทั้งหมด</b></td>
                        <?php
                        if (empty($total_top_keep)) {
                            $show_total_top = '0';                            
                            } else {
                            $show_total_top = $total_top_keep;
                            }
                        ?>
                        <td><b><?php echo number_format( $show_total_top, 0 );?> บาท</b></td>
                    </tr>
            </tfoot>
            </table>
        </div>
    </div>
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
            <thead>
                <tr class="table-success">
                    <td colspan="2">ตัดเก็บสองตัวล่าง</td>
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
                    $down = $conn->prepare("SELECT number, SUM(amount) AS amount FROM lottonumber WHERE typelotto IN ('CB') GROUP BY number");
                    $down->execute();
                    $result_down = $down->fetchAll(); //แสดงข้อมูลทั้งหมด

                    $data_array = array();
                ?>
                <?php foreach($result_down as $rows) {?>
                    <?php 
                        $r = $rows["amount"];
                        if ($r <= $down_keep) {
                            $x = $r;
                        } else {
                            $x = $down_keep;
                        }
                        array_push($data_array,$x);
                        $total_down_keep = array_sum($data_array);
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
                        if (empty($total_down_keep)) {
                            $show_total_down = '0';                            
                            } else {
                            $show_total_down = $total_down_keep;
                            }
                        ?>
                        <td><b><?php echo number_format( $show_total_down, 0 );?> บาท</b></td>
                    </tr>
                <?php } ?>
            </tfoot>
            </table>
        </div>
    </div>
  </div>    
<?php include("./page_report/page_report_foot.php"); ?>