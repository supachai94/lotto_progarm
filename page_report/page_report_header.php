<?php require './connect.php'; ?>
<body>
<div class="container-sm no-print">
    <div class="table-responsive">
        <table class="table table-bordered text-center">
        <thead>
            <tr class="table-primary">
                <th>สองตัวบน</th>
                <th>สองตัวล่าง</th>
                <th>สามตัวบน</th>
                <th>สามตัวล่าง</th>
                <th>สามตัวโต๊ด</th>
            </tr>
        </thead>
        <tbody>
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
            <tr class="table-secondary">
                <td><b><?php echo number_format( $top2, 0 ); ?> บาท</td>
                <td><b><?php echo number_format( $down2, 0 ); ?> บาท</td>
                <td><b><?php echo number_format( $top3, 0 );  ?> บาท</td>
                <td><b><?php echo number_format( $down3, 0 ); ?> บาท</td>
                <td><b><?php echo number_format( $rv3, 0 ); ?> บาท</td>
            </tr>
            <tr class="table-warning">
                <td colspan="5"><b>ยอดรวมทั้งหมด <?php echo number_format( $total_all, 0 ); ?> บาท</b></td>
            </tr>
        </tbody>
        </table>
    </div>
</div>

<div class="container-sm no-print">
    <div class="table-responsive">
        <table class="table table-bordered text-center">
        <tbody>
            <tr class="table-primary">
                <td colspan="2"><a class="nav-link active" aria-current="page" href="main.php?page=report_2"><span>>>คลิก ดูรายละเอียด 2ตัว ทั้งหมด<<</span></a></td>
                <td colspan="2"><a class="nav-link active" aria-current="page" href="main.php?page=report_3"><span>>>คลิก ดูรายละเอียด 3ตัว ทั้งหมด<<</span></a></td>
            </tr>
            <tr>
                <td class="table-success"><a class="nav-link active" aria-current="page" href="main.php?page=report_2_keep"><span>ตัดเก็บ</span></a></td>
                <td class="table-danger"><a class="nav-link active" aria-current="page" href="main.php?page=report_2_send"><span>ตัดส่ง</span></a></td>
                <td class="table-success"><a class="nav-link active" aria-current="page" href="main.php?page=report_3_keep"><span>ตัดเก็บ</span></a></td>
                <td class="table-danger"><a class="nav-link active" aria-current="page" href="main.php?page=report_3_send"><span>ตัดส่ง</span></a></td>
            </tr>
        </tbody>
        </table>
    </div>
</div>





