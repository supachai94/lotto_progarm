<div class="container">
    <div class="row">
        <div class="col-md-12"> <br>
            <h3>จัดการตัวแทนจำหน่าย <a href="main.php?page=add_dealer" class="btn btn-info">+เพิ่มข้อมูล</a> </h3>
            <table class="table table-striped  table-hover table-responsive table-bordered align-middle">
                <thead>
                    <tr>
                        <th width="5%">ลำดับ</th>
                        <th width="40%">ชื่อ</th>
                        <th width="45%">%ส่วนลด</th>
                        <th width="5%">แก้ไข</th>
                        <th width="5%">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //คิวรี่ข้อมูลมาแสดงในตาราง
                    require_once 'connect.php';
                    $stmt = $conn->prepare("SELECT * FROM dealer;");
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    $i =0;
                    ?>
                    <?php foreach($result as $k) { ?>
                        <?php
                        $i++;

                        $id = $k['dealer_id'];
                        $get_show = $conn->prepare("SELECT SUM(amount) AS amount FROM `lottonumber` WHERE `dealer_id` = $id;");
                        $get_show->execute();
                        $g_show = $get_show->fetchAll();

                        $x = $g_show[0][0];
                        $sum_all = $x;
                        $x_sum = "(".number_format($sum_all, 0 ).")";
                        if ($x > 0) {
                            $show_sum = $x_sum;
                        } else {
                            $show_sum = "";
                        }
                        ?>
                    <tr>
                        <td class="text-center"><?php echo $i ?></td>
                            <td><?= $k['name'];?> 
                                <a href="./page_report/page_report_dealer.php?id=<?= $k['dealer_id'];?>"><span><?php echo $show_sum ?></span></a>
                            </td>
                        </form>
                        <td><?= $k['discount'];?></td>
                        <td class="text-center"><a href="./page_dealer/page_dealer_edit.php?id=<?= $k['dealer_id'];?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                        <td class="text-center"><a href="./page_dealer/page_dealer_del.php?id=<?= $k['dealer_id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 



?>