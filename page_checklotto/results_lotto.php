<?php require './connect.php';

require './page_keydata/function_keydata.php';
// Check if the form has been submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the value of the input fields with their respective IDs
    $two_lower        = $_POST['two-lower'];
    $three_upper      = $_POST['three-upper'];
    $three_lower_1    = $_POST['three-lower-1'];
    $three_lower_2    = $_POST['three-lower-2'];
    $three_lower_3    = $_POST['three-lower-3'];
    $three_lower_4    = $_POST['three-lower-4'];

    $x = str_split($three_upper,1);
    $two_upper = $x[1].$x[2];
    // You can now use these variables in your code

    if (empty($two_upper)) {
        # code...
    } else {
        //ดึงขอมูลสองตัวบน
        $top2 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` LIKE 'CA' AND `number` LIKE $two_upper;");
        $top2->execute();
        $result_top2 = $top2->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    if (empty($two_lower)) {
        # code...
    } else {
        //ดึงขอมูลสองตัวล่าง
        $down2 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` LIKE 'CB' AND `number` LIKE $two_lower;");
        $down2->execute();
        $result_down2 = $down2->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    if (empty($three_upper)) {
        # code...
    } else {
        //ดึงขอมูลสามตัวบน
        $top3 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` LIKE 'AB' AND `number` LIKE $three_upper;");
        $top3->execute();
        $result_top3 = $top3->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    if (empty($three_lower_1) && empty($three_lower_2) && empty($three_lower_3) && empty($three_lower_4)) {
        # code...
    } else {
        //ดึงขอมูลสามตัวล่าง
        $down3 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` IN ('AC') AND (`number` LIKE $three_lower_1 OR `number` LIKE $three_lower_2 OR `number` LIKE $three_lower_3 OR `number` LIKE $three_lower_4);");
        $down3->execute();
        $result_down3 = $down3->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    if (empty($three_upper)) {
        # code...
    } else {
        $a = $three_upper;
        $_a = str_split($a);
        $rv = permutation($_a);
        $rv_min = min($rv);
        //ดึงขอมูลสามตัวโต๊ด
        $rv3 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` LIKE 'AD' AND `number` LIKE $rv_min;");
        $rv3->execute();
        $result_rv3 = $rv3->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    //ตรวจเลขหกประตูบน
    if (empty($three_upper)) {
        # code...
    } else {
        $u = str_split($three_upper,1);
        $first = $u[0];
        $second = $u[1];
        $third = $u[2];
        //ดึงขอมูลสามตัวโต๊ด
        $door6 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` IN ('XC') AND (number LIKE '%$first%' AND number LIKE '%$second%' AND number LIKE '%$third%');");
        $door6->execute();
        $result_6door_top = $door6->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    //ตรวจเลขสามประตูบน
    if (empty($three_upper)) {
        # code...
    } else {
        $u = str_split($three_upper,1);
        $first = $u[0];
        $second = $u[1];
        $third = $u[2];
        //ดึงขอมูลสามตัวโต๊ด
        $door3 = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` IN ('XA') AND (number LIKE '%$first%' AND number LIKE '%$second%' AND number LIKE '%$third%');");
        $door3->execute();
        $result_3door_top = $door3->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    //ตรวจเลขหกประตูล่าง
    if (empty($three_lower_1) && empty($three_lower_2) && empty($three_lower_3) && empty($three_lower_4)) {
        # code...
    } else {
        $i = str_split($three_lower_1,1);
        $first1  = $i[0];
        $second1 = $i[1];
        $third1  = $i[2];

        $j = str_split($three_lower_2,1);
        $first2  = $j[0];
        $second2 = $j[1];
        $third2  = $j[2];

        $k = str_split($three_lower_3,1);
        $first3  = $k[0];
        $second3 = $k[1];
        $third3  = $k[2];

        $l = str_split($three_lower_4,1);
        $first4  = $l[0];
        $second4 = $l[1];
        $third4  = $l[2];

        //ดึงขอมูลสามตัวล่าง
        $door6down = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` IN ('XD') 
                                    AND ((number LIKE '%$first1%' AND number LIKE '%$second1%' AND number LIKE '%$third1%') 
                                      OR (number LIKE '%$first2%' AND number LIKE '%$second2%' AND number LIKE '%$third2%') 
                                      OR (number LIKE '%$first3%' AND number LIKE '%$second3%' AND number LIKE '%$third3%') 
                                      OR (number LIKE '%$first4%' AND number LIKE '%$second4%' AND number LIKE '%$third4%'));");
        $door6down->execute();
        $result_6door_down = $door6down->fetchAll(); //แสดงข้อมูลทั้งหมด
    }

    //ตรวจเลขสามประตูล่าง
    if (empty($three_lower_1) && empty($three_lower_2) && empty($three_lower_3) && empty($three_lower_4)) {
        # code...
    } else {
        $i = str_split($three_lower_1,1);
        $first1  = $i[0];
        $second1 = $i[1];
        $third1  = $i[2];

        $j = str_split($three_lower_2,1);
        $first2  = $j[0];
        $second2 = $j[1];
        $third2  = $j[2];

        $k = str_split($three_lower_3,1);
        $first3  = $k[0];
        $second3 = $k[1];
        $third3  = $k[2];

        $l = str_split($three_lower_4,1);
        $first4  = $l[0];
        $second4 = $l[1];
        $third4  = $l[2];

        //ดึงขอมูลสามตัวล่าง
        $door3down = $conn->prepare("SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE `typelotto` IN ('XB') 
                                    AND ((number LIKE '%$first1%' AND number LIKE '%$second1%' AND number LIKE '%$third1%') 
                                      OR (number LIKE '%$first2%' AND number LIKE '%$second2%' AND number LIKE '%$third2%') 
                                      OR (number LIKE '%$first3%' AND number LIKE '%$second3%' AND number LIKE '%$third3%') 
                                      OR (number LIKE '%$first4%' AND number LIKE '%$second4%' AND number LIKE '%$third4%'));");
        $door3down->execute();
        $result_3door_down = $door3down->fetchAll(); //แสดงข้อมูลทั้งหมด
    }
    
}

$data_array = array();
 
$data_two_upper    = array();
$data_two_lower    = array();
$data_three_upper  = array();
$data_three_lower  = array();
$data_rv3          = array();






?>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
<body>


<div class="card">
    <div class="card-header text-center">
        <h4 class="card-header text-center bg-light">รายการผู้ถูกรางวัล</h4>
    </div>
</div>
    <div class="row align-items-start">
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สองตัวบน
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $two_upper ?></h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สองตัวล่าง
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $two_lower ?></h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวบน
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $three_upper ?></h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวล่าง1
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $three_lower_1 ?></h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวล่าง2
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $three_lower_2 ?></h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวล่าง3
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $three_lower_3 ?></h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวล่าง4
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $three_lower_4 ?></h5>
            </div>
            </div>
        </div>
    </div>

<div class="card">
  <div class="card-body">
  <h4 class="card-header text-center bg-light">รายละเอียด</h4>
    <table class="table table-hover text-center table-light">
        <thead>
            <tr>
                <th>ประเภทหวย</th>
                <th>ตัวเลข</th>
                <th>จำนวนเงิน</th>
                <th>ตัวแทนจำหน่าย</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($result_top2 as $result_top2s) {
                        array_push($data_two_upper,$result_top2s["amount"]);
                    echo "<tr>
                            <td>" . "สองตัวบน" . "</td>
                            <td>" . $result_top2s["number"] . "</td>
                            <td>" . $result_top2s["amount"] . "</td>
                            <td>" . $result_top2s["name"] . "</td>
                        </tr>";
                        }
                foreach ($result_down2 as $result_down2s) {
                        array_push($data_two_lower,$result_down2s["amount"]);
                    echo "<tr>
                            <td>" . "สองตัวล่าง" . "</td>
                            <td>" . $result_down2s["number"] . "</td>
                            <td>" . $result_down2s["amount"] . "</td>
                            <td>" . $result_down2s["name"] . "</td>
                          </tr>";
                        }
                foreach ($result_top3 as $result_top3s) {
                        array_push($data_three_upper,$result_top3s["amount"]);
                    echo "<tr>
                            <td>" . "สามตัวบน" . "</td>
                            <td>" . $result_top3s["number"] . "</td>
                            <td>" . $result_top3s["amount"] . "</td>
                            <td>" . $result_top3s["name"] . "</td>
                          </tr>";
                        }
                foreach ($result_down3 as $result_down3s) {
                        array_push($data_three_lower,$result_down3s["amount"]);
                    echo "<tr>
                            <td>" . "สามตัวล่าง" . "</td>
                            <td>" . $result_down3s["number"] . "</td>
                            <td>" . $result_down3s["amount"] . "</td>
                            <td>" . $result_down3s["name"] . "</td>
                          </tr>";
                        }
                foreach ($result_rv3 as $result_rv3s) {
                        array_push($data_rv3,$result_rv3s["amount"]);
                    echo "<tr>
                            <td>" . "สามตัวโต๊ด" . "</td>
                            <td>" . $result_rv3s["number"] . "</td>
                            <td>" . $result_rv3s["amount"] . "</td>
                            <td>" . $result_rv3s["name"] . "</td>
                          </tr>";
                        }
                foreach ($result_6door_top as $result_6door_tops) {
                        array_push($data_rv3,$result_6door_tops["amount"]);
                    echo "<tr>
                            <td>" . "เลขหกประตูบน" . "</td>
                            <td>" . $result_6door_tops["number"] . "</td>
                            <td>" . $result_6door_tops["amount"] . "</td>
                            <td>" . $result_6door_tops["name"] . "</td>
                          </tr>";
                        }
                foreach ($result_6door_down as $result_6door_downs) {
                        array_push($data_rv3,$result_6door_downs["amount"]);
                    echo "<tr>
                            <td>" . "เลขหกประตูล่าง" . "</td>
                            <td>" . $result_6door_downs["number"] . "</td>
                            <td>" . $result_6door_downs["amount"] . "</td>
                            <td>" . $result_6door_downs["name"] . "</td>
                          </tr>";
                        }
                foreach ($result_3door_top as $result_3door_tops) {
                        array_push($data_rv3,$result_3door_tops["amount"]);
                    echo "<tr>
                            <td>" . "เลขสามประตูบน" . "</td>
                            <td>" . $result_3door_tops["number"] . "</td>
                            <td>" . $result_3door_tops["amount"] . "</td>
                            <td>" . $result_3door_tops["name"] . "</td>
                          </tr>";
                        }
                foreach ($result_3door_down as $result_3door_downs) {
                        array_push($data_rv3,$result_3door_downs["amount"]);
                    echo "<tr>
                            <td>" . "เลขสามประตูล่าง" . "</td>
                            <td>" . $result_3door_downs["number"] . "</td>
                            <td>" . $result_3door_downs["amount"] . "</td>
                            <td>" . $result_3door_downs["name"] . "</td>
                          </tr>";
                        }
            ?>
        </tbody>
    </table>
  </div>
</div>

<?php 
$total_two_upper = array_sum($data_two_upper);
$total_two_lower = array_sum($data_two_lower);
$total_three_upper = array_sum($data_three_upper);
$total_three_lower = array_sum($data_three_lower);   
$total_rv3 = array_sum($data_rv3);
?>

<div class="row align-items-start">
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สองตัวบน
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo number_format( $total_two_upper, 0 ); ?> บาท</h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สองตัวล่าง
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo number_format( $total_two_lower, 0 ); ?> บาท</h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวบน
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo number_format( $total_three_upper, 0 ); ?> บาท</h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวล่าง
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo number_format( $total_three_lower, 0 ); ?> บาท</h5>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header text-center">
                สามตัวโต๊ด
            </div>
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo number_format( $total_rv3, 0 ); ?> บาท</h5>
            </div>
            </div>
        </div>
    </div>