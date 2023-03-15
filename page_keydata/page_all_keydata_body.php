<?php

if (empty ($dealer_id)) {
    //query data
    $stmt = $conn->prepare("SELECT * FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto IN ('CA', 'CB', 'AB', 'AC', 'AD') AND lottonumber.dealer_id ORDER BY date DESC;");
    $stmt->execute();
    $result = $stmt->fetchAll(); //แสดงข้อมูลทั้งหมด
    # code...
} else {
    //query data
    $stmt = $conn->prepare("SELECT * FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto IN ('CA', 'CB', 'AB', 'AC', 'AD') AND lottonumber.dealer_id LIKE $dealer_id ORDER BY date DESC;");
    $stmt->execute();
    $result = $stmt->fetchAll(); //แสดงข้อมูลทั้งหมด
    # code...
}

?>


<form method="post">
        <div class="table-responsive" style="overflow: auto; display: block; height: 600px; width: 100%; margin: 0 auto;">
                <table class="table table-bordered border-warning table-warning table-striped table-hover text-center" >
                    <thead class="table bg-warning bg-gradient border-warning text-dark">
                        <tr>
                            <td><strong>ประเภทหวย</strong></td>
                            <td><strong>ตัวเลข</strong></td>
                            <td><strong>จำนวนเงิน</strong></td>
                            <td><strong>ผู้ซื้อ</strong></td>
                            <td><strong>วันที่</strong></td>
                            <td><strong>เลือกที่ต้องการลบ</strong></td>					
                        </tr>
                    </thead>
                <tbody >
                    <?php foreach ($result as $rows){ ?>
                        <?php $X = $rows['typelotto'];
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
                        <td style="width: 10%;"><?php echo $X; ?></td>
                        <td style="width: 10%;"><?php echo $rows["number"]; ?></td>
                        <td style="width: 20%;"><?php echo number_format( $rows["amount"], 0 ) ?></td>
                        <td style="width: 20%;"><?php echo $rows["name"]; ?></td>
                        <td style="width: 20%;"><?php echo $rows["date"]; ?></td>
                        <td style="width: 10%;">
                        <!-- ส่ง  checkbox เป็น array -->
                        <input name="del[]" type="checkbox"  value="<?php echo $rows['lottonumber_id']; ?>"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
    <div class="text-center">
    <button type="submit" class="btn btn-danger">ลบข้อมูล</button>
    &nbsp; 
    <a class="btn btn-secondary" href="./main.php?page=keydata_normal">ย้อนกลับ</a>
</div>
</form>

<?php 
//exit();

if (isset($_POST['del'])) {
//implode cut last comma
$checked = implode(" , ", $_POST['del']);

//sql delete where in
$stmt = $conn->prepare("DELETE FROM lottonumber WHERE lottonumber_id IN ($checked)");
$stmt->execute();

if  (! headers_sent()) {
    header("Location: ./main.php?page=keydata_normal");
} else {
    echo '<script type="text/javascript">
            window.location = "./main.php?page=keydata_normal";
        </script>';
}

}
?>