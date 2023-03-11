<?php
session_start();
require_once 'function_keydata.php';

//fcตรวจตัวเลขว่าเป็น2ตัวหรือ3ตัวและรับค่าจำนวนเงิน บน ล่าง โต๊ด และสลับตัวเลข 2 ตัวตัว เสร็จแล้ว
//type คือประเภทของหวย 1 = สองตัวบน 2 = สองตัวล่าง 3 = สามตัวบน 4 = สามตัวล่าง 5 = สามตัวโต๊ด
//$type = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าอินพุตจากข้อมูลในแบบฟอร์ม
    $select_dealer_special      = $_POST['select_dealer_special'];
    $select_lotto_type  = $_POST['select_lotto_type'];
    $amount             = $_POST['amount'];
    $number             = $_POST['number'];

    // เก็บค่าที่ป้อนไว้ในตัวแปรเซสชันสำหรับคำขอถัดไป
    $_SESSION['last_select_dealer']       = $select_dealer_special;
    $_SESSION['last_select_lotto_type']   = $select_lotto_type;  
    $_SESSION['last_amount']              = $amount;  
    $_SESSION['last_number']              = $number;  

    if (empty ($_POST['top'])) {
      $top = 'N';
    } else {
        $top = 'Y';
    }
    
    if (empty ($_POST['down'])) {
        $down = 'N';
    } else {
        $down = 'Y';
    }
    
    if (empty ((int)$select_dealer_special)) {
      $_SESSION['dealer_empty'] = "กรุณาเลือกคนเดินโพยหวย";
        if  (! headers_sent()) {
          header("Location: ../main.php?page=keydata_special");
        } else {
            echo '<script type="text/javascript">
                    window.location = "../main.php?page=keydata_special";
                  </script>';
        }
    } else {
      if ($select_lotto_type == "1") {

          if ((int)$amount > 0) {

              if (empty ($number)) {
                $_SESSION['num_empty'] = "กรุณาใส่ตัวเลข";
                  if  (! headers_sent()) {
                    header("Location: ../main.php?page=keydata_special");
                  } else {
                      echo '<script type="text/javascript">
                              window.location = "../main.php?page=keydata_special";
                            </script>';
                  }
              } else {
                  $a = $number;
                  $_a = str_split($a);
                  $rv = permutation($_a);
                  if (count($rv) == 3) {
                      if ($top == "Y" && $down == "Y") {     
                          send_3doortopdb($input_number = $rv, $top_amount = $amount, $dealer_id = $select_dealer_special);
                          send_3doordowndb($input_number = $rv, $down_amount = $amount, $dealer_id = $select_dealer_special);
                          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_special");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_special";
                                    </script>';
                          }                  
                      } elseif($top == "Y" && $down == "N"){
                          send_3doortopdb($input_number = $rv, $top_amount = $amount, $dealer_id = $select_dealer_special);
                          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_special");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_special";
                                    </script>';
                          }                  
                      } elseif($top == "N" && $down == "Y"){
                          send_3doordowndb($input_number = $rv, $down_amount = $amount, $dealer_id = $select_dealer_special);
                          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_special");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_special";
                                    </script>';
                          }                  
                      } else {
                          # code...
                      }
                  } else {
                    $_SESSION['check_num_type'] = "ไม่ใช่เลขสามประตู";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_special");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_special";
                                    </script>';
                          }
                  }
              }
          } else {
            $_SESSION['amount_empty'] = "กรุณาใส่จำนวนเงิน";
            if  (! headers_sent()) {
              header("Location: ../main.php?page=keydata_special");
            } else {
                echo '<script type="text/javascript">
                        window.location = "../main.php?page=keydata_special";
                      </script>';
            }
          }
      } elseif ($select_lotto_type == "2") {
          if ((int)$amount > 0) {
              if (empty ($number)) {
                $_SESSION['num_empty'] = "กรุณาใส่ตัวเลข";
                if  (! headers_sent()) {
                  header("Location: ../main.php?page=keydata_special");
                } else {
                    echo '<script type="text/javascript">
                            window.location = "../main.php?page=keydata_special";
                          </script>';
                }
              } else {
                  $a = $number;
                  $_a = str_split($a);
                  $rv = permutation($_a);
                  if (count($rv) <= 6 AND count($rv) >= 3) {
                      if ($top == "Y" && $down == "Y") {     
                          send_6doortopdb($input_number = $rv, $top_amount = $amount, $dealer_id = $select_dealer_special);
                          send_6doordowndb($input_number = $rv, $down_amount = $amount, $dealer_id = $select_dealer_special);
                          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_special");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_special";
                                    </script>';
                          }                                     
                      } elseif($top == "Y" && $down == "N"){
                          send_6doortopdb($input_number = $rv, $top_amount = $amount, $dealer_id = $select_dealer_special);
                          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_special");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_special";
                                    </script>';
                          }                  
                      } elseif($top == "N" && $down == "Y"){
                          send_6doordowndb($input_number = $rv, $down_amount = $amount, $dealer_id = $select_dealer_special);
                          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_special");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_special";
                                    </script>';
                          }                  
                      } else {
                          # code...
                      }                 
                  } else {
                    $_SESSION['check_num_type'] = "ไม่ใช่เลขหกประตู";
                    if  (! headers_sent()) {
                      header("Location: ../main.php?page=keydata_special");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_special";
                              </script>';
                    }
                  }
              }
          } else {
            $_SESSION['amount_empty'] = "กรุณาใส่จำนวนเงิน";
            if  (! headers_sent()) {
              header("Location: ../main.php?page=keydata_special");
            } else {
                echo '<script type="text/javascript">
                        window.location = "../main.php?page=keydata_special";
                      </script>';
            }
          }
      } else {
        $_SESSION['num_empty'] = "กรุณาเลือกประเภทหวย";
        if  (! headers_sent()) {
          header("Location: ../main.php?page=keydata_special");
        } else {
            echo '<script type="text/javascript">
                    window.location = "../main.php?page=keydata_special";
                  </script>';
        }
      }
  }
  } else {
    if  (! headers_sent()) {
      header("Location: ../main.php?page=keydata_special");
    } else {
        echo '<script type="text/javascript">
                window.location = "../main.php?page=keydata_special";
              </script>';
    }
  }
?>