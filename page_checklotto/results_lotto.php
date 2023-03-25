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
        echo "ไม่มีคนถูกหวย";
    } else {
        // กำหนดค่าสตริงสำหรับคำสั่ง SQL
        $search_typelotto = 'CA';
        $search_number = $two_upper;

        // สร้างคำสั่ง SQL ที่ต้องการพร้อมกับ bind ค่า parameter
        $sql = "SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto LIKE ? AND number LIKE ?";

        // เตรียมคำสั่ง SQL สำหรับการ execute พร้อมกับ bind ค่า parameter
        $top2 = $conn->prepare($sql);
        $top2->execute(["%$search_typelotto%", "%$search_number%"]);
    }

    if (empty($two_lower)) {
        echo "ไม่มีคนถูกหวย";
    } else {
        // กำหนดค่าสตริงสำหรับคำสั่ง SQL
        $search_typelotto = 'CB';
        $search_number = $two_lower;
    
        // สร้างคำสั่ง SQL ที่ต้องการพร้อมกับ bind ค่า parameter
        $sql = "SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto LIKE ? AND number LIKE ?";
    
        // เตรียมคำสั่ง SQL สำหรับการ execute พร้อมกับ bind ค่า parameter
        $down2 = $conn->prepare($sql);
        $down2->execute(["%$search_typelotto%", "%$search_number%"]);
    }

    if (empty($three_upper)) {
        echo "ไม่มีคนถูกหวย";
    } else {
        // กำหนดค่าสตริงสำหรับคำสั่ง SQL
        $search_typelotto = 'AB';
        $search_number = $three_upper;
        
        // สร้างคำสั่ง SQL ที่ต้องการพร้อมกับ bind ค่า parameter
        $sql = "SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto LIKE ? AND number LIKE ?";
        
        // เตรียมคำสั่ง SQL สำหรับการ execute พร้อมกับ bind ค่า parameter
        $top3 = $conn->prepare($sql);
        $top3->execute(["%$search_typelotto%", "%$search_number%"]);

    }

    if (empty($three_lower_1) && empty($three_lower_2) && empty($three_lower_3) && empty($three_lower_4)) {
        echo "ไม่มีคนถูกหวย";
    } else {
            
        // กำหนดค่าสตริงสำหรับคำสั่ง SQL
        $search_typelotto = 'AC';
        $search_number1 = $three_lower_1;
        $search_number2 = $three_lower_2;
        $search_number3 = $three_lower_3;
        $search_number4 = $three_lower_4;
        
        // สร้างคำสั่ง SQL ที่ต้องการพร้อมกับ bind ค่า parameter
        $sql = "SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto LIKE ? AND (number LIKE ? OR number LIKE ? OR number LIKE ? OR number LIKE ?)";
        
        // เตรียมคำสั่ง SQL สำหรับการ execute พร้อมกับ bind ค่า parameter
        $down3 = $conn->prepare($sql);
        $down3->execute(["%$search_typelotto%", "%$search_number1%", "%$search_number2%", "%$search_number3%", "%$search_number4%"]);
    }

    if (empty($three_upper)) {
        echo "ไม่มีคนถูกหวย";
    } else {
        $a = $three_upper;
        $_a = str_split($a);
        $rv = permutation($_a);
        $rv_min = min($rv);

        // กำหนดค่าสตริงสำหรับคำสั่ง SQL
        $search_typelotto = 'AD';
        $search_number = $rv_min;
        
        // สร้างคำสั่ง SQL ที่ต้องการพร้อมกับ bind ค่า parameter
        $sql = "SELECT lottonumber.typelotto, lottonumber.number, lottonumber.amount, dealer.name FROM lottonumber INNER JOIN dealer ON lottonumber.dealer_id = dealer.dealer_id WHERE typelotto LIKE ? AND number LIKE ?";
        
        // เตรียมคำสั่ง SQL สำหรับการ execute พร้อมกับ bind ค่า parameter
        $rv3 = $conn->prepare($sql);
        $rv3->execute(["%$search_typelotto%", "%$search_number%"]);
        
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
  <h4 class="card-header text-center bg-light">เลขรางวัลสองตัวบน <?php echo $two_upper ?></h4>
    <table class="table table-hover text-center table-primary">
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
                // ดึงข้อมูลทั้งหมดและแสดงผล
                if ($top2->rowCount() > 0) {
                    // ใช้ foreach loop เพื่อแสดงผลข้อมูลทีละแถว
                    foreach($top2->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        array_push($data_two_upper,$row["amount"]);
                        $X = $row["typelotto"];
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
                        echo "<tr>
                            <td>" . $X . "</td>
                            <td>" . $row["number"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["name"] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<td colspan=" . 4 . ">ไม่มีผู้ถูกรางวัล</td>";
                }
            ?>
        </tbody>
    </table>
  </div>
</div>

<div class="card">
  <div class="card-body">
  <h4 class="card-header text-center bg-light">เลขรางวัลสองตัวล่าง <?php echo $two_lower ?></h4>
    <table class="table table-hover text-center table-success">
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
                // ดึงข้อมูลทั้งหมดและแสดงผล
                if ($down2->rowCount() > 0) {
                    // ใช้ foreach loop เพื่อแสดงผลข้อมูลทีละแถว
                    foreach($down2->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        array_push($data_two_lower,$row["amount"]);
                        $X = $row["typelotto"];
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
                        echo "<tr>
                            <td>" . $X . "</td>
                            <td>" . $row["number"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["name"] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<td colspan=" . 4 . ">ไม่มีผู้ถูกรางวัล</td>";
                }
            ?>
        </tbody>
    </table>
  </div>
</div>

<div class="card">
  <div class="card-body">
  <h4 class="card-header text-center bg-light">เลขรางวัลสามตัวบน <?php echo $three_upper ?></h4>
    <table class="table table-hover text-center table-danger">
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
                // ดึงข้อมูลทั้งหมดและแสดงผล
                if ($top3->rowCount() > 0) {
                    // ใช้ foreach loop เพื่อแสดงผลข้อมูลทีละแถว
                    foreach($top3->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        array_push($data_three_upper,$row["amount"]);
                        $X = $row["typelotto"];
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
                        echo "<tr>
                            <td>" . $X . "</td>
                            <td>" . $row["number"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["name"] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<td colspan=" . 4 . ">ไม่มีผู้ถูกรางวัล</td>";
                }
            ?>
        </tbody>
    </table>
  </div>
</div>

<div class="card">
  <div class="card-body">
  <h4 class="card-header text-center bg-light">เลขรางวัลสามตัวล่าง <?php echo $three_lower_1 ?> <?php echo $three_lower_2 ?> <?php echo $three_lower_3 ?> <?php echo $three_lower_4 ?></h4>
    <table class="table table-hover text-center table-warning">
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
                // ดึงข้อมูลทั้งหมดและแสดงผล
                if ($down3->rowCount() > 0) {
                    // ใช้ foreach loop เพื่อแสดงผลข้อมูลทีละแถว
                    foreach($down3->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        array_push($data_three_lower,$row["amount"]);
                        $X = $row["typelotto"];
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
                        echo "<tr>
                            <td>" . $X . "</td>
                            <td>" . $row["number"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["name"] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<td colspan=" . 4 . ">ไม่มีผู้ถูกรางวัล</td>";
                }
            ?>
        </tbody>
    </table>
  </div>
</div>

<div class="card">
  <div class="card-body">
  <h4 class="card-header text-center bg-light">เลขรางวัลสามตัวโต๊ด <?php echo $rv_min ?> (<?php echo $three_upper ?>)</h4>
    <table class="table table-hover text-center table-info">
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
                // ดึงข้อมูลทั้งหมดและแสดงผล
                if ($rv3->rowCount() > 0) {
                    // ใช้ foreach loop เพื่อแสดงผลข้อมูลทีละแถว
                    foreach($rv3->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        array_push($data_rv3,$row["amount"]);
                        $X = $row["typelotto"];
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
                        echo "<tr>
                            <td>" . $X . "</td>
                            <td>" . $row["number"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["name"] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<td colspan=" . 4 . ">ไม่มีผู้ถูกรางวัล</td>";
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