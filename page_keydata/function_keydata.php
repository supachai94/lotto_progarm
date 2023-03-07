<?php

function send_topdb($input_number, $top_amount, $dealer_id) {
    require '../connect.php';
    if ($top_amount > 0 )
    $typelotto = "CA";
    $data_insert = $conn->prepare("INSERT INTO lottonumber (typelotto, number , date, amount, dealer_id) VALUES (:typelotto, :input_number, current_timestamp(), :top_amount, :dealer_id)");
    $data_insert->bindParam(':typelotto', $typelotto , PDO::PARAM_STR);
    $data_insert->bindParam(':input_number', $input_number , PDO::PARAM_STR);
    $data_insert->bindParam(':top_amount', $top_amount , PDO::PARAM_INT);
    $data_insert->bindParam(':dealer_id', $dealer_id , PDO::PARAM_INT);
    $data_insert->execute();
    $conn = null; //close connect db
    //echo "saved";
}

function send_downdb($input_number, $down_amount, $dealer_id) {
    require '../connect.php';
    if ($down_amount > 0 )
    $typelotto = "CB";
    $data_insert = $conn->prepare("INSERT INTO lottonumber (typelotto, number , date, amount, dealer_id) VALUES (:typelotto, :input_number, current_timestamp(), :down_amount, :dealer_id)");
    $data_insert->bindParam(':typelotto', $typelotto , PDO::PARAM_STR);
    $data_insert->bindParam(':input_number', $input_number , PDO::PARAM_STR);
    $data_insert->bindParam(':down_amount', $down_amount , PDO::PARAM_INT);
    $data_insert->bindParam(':dealer_id', $dealer_id , PDO::PARAM_INT);
    $data_insert->execute();
    $conn = null; //close connect db
    //echo "saved";
}

function send_alternatedb($input_number, $alternate, $dealer_id) {
    require '../connect.php';
    if (substr($input_number,-1,1) !== substr($input_number,-2,1)){
    $input_rv = substr($input_number,-1,1).substr($input_number,-2,1);
    //กลับต้องกลับทั้งบนทั้งล่าง
    $top_amount = $alternate;
    $down_amount = $alternate;
    send_topdb($input_rv, (int)$top_amount, (int)$dealer_id); // call the function
    //send_topdb($input_rv, $top_amount, $dealer_id);
    send_downdb($input_rv, (int)$down_amount, (int)$dealer_id); // call the function
    //send_downdb($input_rv, $down_amount, $dealer_id);

    }else {
            //echo "เลขซ้ำกลับไม่ได้";
        }

    //echo "saved";
}

function send_3topdb($input_number, $top_amount, $dealer_id) {
    require '../connect.php';
    if ($top_amount > 0 )
    $typelotto = "AB";
    $data_insert = $conn->prepare("INSERT INTO lottonumber (typelotto, number , date, amount, dealer_id) VALUES (:typelotto, :input_number, current_timestamp(), :top_amount, :dealer_id)");
    $data_insert->bindParam(':typelotto', $typelotto , PDO::PARAM_STR);
    $data_insert->bindParam(':input_number', $input_number , PDO::PARAM_STR);
    $data_insert->bindParam(':top_amount', $top_amount , PDO::PARAM_INT);
    $data_insert->bindParam(':dealer_id', $dealer_id , PDO::PARAM_INT);
    $data_insert->execute();
    $conn = null; //close connect db
}

function send_3downdb($input_number, $down_amount, $dealer_id) {
    require '../connect.php';
    if ($down_amount > 0 )
    $typelotto = "AC";
    $data_insert = $conn->prepare("INSERT INTO lottonumber (typelotto, number , date, amount, dealer_id) VALUES (:typelotto, :input_number, current_timestamp(), :down_amount, :dealer_id)");
    $data_insert->bindParam(':typelotto', $typelotto , PDO::PARAM_STR);
    $data_insert->bindParam(':input_number', $input_number , PDO::PARAM_STR);
    $data_insert->bindParam(':down_amount', $down_amount , PDO::PARAM_INT);
    $data_insert->bindParam(':dealer_id', $dealer_id , PDO::PARAM_INT);
    $data_insert->execute();
    $conn = null; //close connect db
    //echo "saved";
}

function send_3alternatedb($input_number, $alternate, $dealer_id) {
    require '../connect.php';
    $a = $input_number;
    $_a = str_split($a);
    $rv = permutation($_a);
    $rv_min = min($rv);
        if (count($rv) > 1) {
            $typelotto = "AD";
            $data_insert = $conn->prepare("INSERT INTO lottonumber (typelotto, number , date, amount, dealer_id) VALUES (:typelotto, :input_number, current_timestamp(), :alternate, :dealer_id)");
            $data_insert->bindParam(':typelotto', $typelotto , PDO::PARAM_STR);
            $data_insert->bindParam(':input_number', $rv_min , PDO::PARAM_STR);
            $data_insert->bindParam(':alternate', $alternate , PDO::PARAM_INT);
            $data_insert->bindParam(':dealer_id', $dealer_id , PDO::PARAM_INT);
            $data_insert->execute();
            //โต๊ดคือตัวเลขทั้ง3ตัวถูกแต่ตำแหน่งไหนก็ได้
            //บันทึกลงตารางเป็น 123 แต่เวลาเช็คต้องเป็น 312 132 123 321 231 213 ต้องไหนก็ถูก
        } else {
            //echo "เลขโต๊ดซ้ำกัน3คัว บันทึกข้อมูลไม่ได้";
        }
    $conn = null; //close connect db
    //echo "saved";
}

function permutation($_a, $buffer='', $delimiter='') {
    $output = array();

    $num = count($_a);
    if ($num > 1) {
        foreach ($_a as $key=>$val) {
            $temp = $_a;
            unset($temp[$key]);
            sort($temp);

            $return = permutation($temp, trim($buffer.$delimiter.$val, $delimiter), $delimiter);

            if(is_array($return)) {
                $output = array_merge($output, $return);
                $output = array_unique($output);
            }
            else {
                $output[] = $return;
            }
        }
        return $output;
    }
    else {
        return $buffer.$delimiter.$_a[0];
    }
}

function send_3doortopdb($input_number, $top_amount, $dealer_id) {
    require '../connect.php';
    $typelotto = "XA";

    foreach($input_number as $num) {
        send_3topdb($num, $top_amount, $dealer_id);
    }
    $conn = null; //close connect db
}

function send_3doordowndb($input_number, $down_amount, $dealer_id) {
    require '../connect.php';
    $typelotto = "XB";

    foreach($input_number as $num) {
        send_3downdb($num, $down_amount, $dealer_id);
    }
    $conn = null; //close connect db
    //echo "saved";
}

function send_6doortopdb($input_number, $top_amount, $dealer_id) {
    require '../connect.php';
    $typelotto = "XC";

    foreach($input_number as $num) {
        send_3topdb($num, $top_amount, $dealer_id);
    }
    $conn = null; //close connect db
}

function send_6doordowndb($input_number, $down_amount, $dealer_id) {
    require '../connect.php';
    $typelotto = "XD";

    foreach($input_number as $num) {
        send_3downdb($num, $down_amount, $dealer_id);
    }
    $conn = null; //close connect db
    //echo "saved";
}

function limit_check($typelotto) {
    require '../connect.php';
    $stmt = $conn->prepare("SELECT* FROM keep");
    $stmt->execute();
    $result = $stmt->fetchAll();
    if  ($typelotto == "XA") {
        $limit = $result[0][5];//3door
        return ((int)$limit);
    } elseif 
        ($typelotto == "XB") {
        $limit = $result[0][5];//3door
        return ((int)$limit);
    } elseif 
        ($typelotto == "XC") {
        $limit = $result[0][6];//6door
        return ((int)$limit);
    } elseif 
        ($typelotto == "XD") {
        $limit = $result[0][6];//6door
        return ((int)$limit);
    } elseif 
        ($typelotto == "CA") {
        $limit = $result[0][0];//keep2top
        return ((int)$limit);
    } elseif 
        ($typelotto == "CB") {
        $limit = $result[0][1];//keep2down
        return ((int)$limit);
    } elseif 
        ($typelotto == "AB") {
        $limit = $result[0][2];//keep3top
        return ((int)$limit);
    } elseif 
        ($typelotto == "AC") {
        $limit = $result[0][3];//keep3down
        return ((int)$limit);
    } elseif 
        ($typelotto == "AD") {
        $limit = $result[0][4];//keep3alternate
        return ((int)$limit);
    }else {
        $limit = "888";
    }
    $conn = null; //close connect db
}

//$amount = 1000;
//$limit = 500;
//$typelotto = "XD";
//
//$stmt = $conn->prepare("SELECT* FROM keep");
//$stmt->execute();
//$result = $stmt->fetchAll();
//
//if ($amount > $limit) {
//    if  ($typelotto == "XA") {
//        $X = "สามประตูบน";
//    } elseif 
//        ($typelotto == "XB") {
//        $X = "สามประตูล่าง";
//    } elseif 
//        ($typelotto == "XC") {
//        $X = "หกประตูบน";
//    } elseif 
//        ($typelotto == "XD") {
//        $X = "หกประตูล่าง"; 
//    } elseif 
//        ($typelotto == "CA") {
//        $X = "สองตัวบน";
//    } elseif 
//        ($typelotto == "CB") {
//        $X = "สองตัวล่าง";
//    } elseif 
//        ($typelotto == "AB") {
//        $X = "สามตัวบน";
//    } elseif 
//        ($typelotto == "AC") {
//        $X = "สามตัวล่าง"; 
//    } elseif 
//        ($typelotto == "AD") {
//        $X = "สามตัวโต๊ด"; 
//    }else {
//        $X = "";
//    }
//    echo "บันทึกตัดส่ง";
//} else {
//    echo "บันทึกข้อมูล";
//}

?>