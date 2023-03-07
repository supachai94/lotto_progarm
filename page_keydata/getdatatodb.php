<?php
require_once 'function_keydata.php';
//fcตรวจตัวเลขว่าเป็น2ตัวหรือ3ตัวและรับค่าจำนวนเงิน บน ล่าง โต๊ด และสลับตัวเลข 2 ตัวตัว เสร็จแล้ว
//type คือประเภทของหวย 1 = สองตัวบน 2 = สองตัวล่าง 3 = สามตัวบน 4 = สามตัวล่าง 5 = สามตัวโต๊ด
//$type = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าอินพุตจากข้อมูลในแบบฟอร์ม
    $input_number   = $_POST['number'];
    $top_amount     = $_POST['top_amount'];
    $down_amount    = $_POST['down_amount'];
    $alternate      = $_POST['alternate'];
    $dealer_id      = $_POST['select_dealer'];

    // เก็บค่าที่ป้อนไว้ในตัวแปรเซสชันสำหรับคำขอถัดไป
    $_SESSION['last_number']        = $input_number;
    $_SESSION['last_top_amount']    = $top_amount;  
    $_SESSION['last_down_amount']   = $down_amount;  
    $_SESSION['last_alternate']     = $alternate;    
    $_SESSION['last_select_dealer'] = $dealer_id;
    
    if (empty ((int)$dealer_id)) {
        echo '<script type ="text/JavaScript">';  
        echo 'alert("กรุณาเลือกคนเดินโพยหวย")';  
        echo '</script>';  
    } else {
        if (strlen($input_number) == 2) {
                if (empty ((int)$top_amount)) {
                    if (empty ((int)$down_amount)) {
                        if (empty ((int)$alternate)) {
                          echo '<script language="javascript">';
                          echo 'alert("กรุณาใส่จำนวนเงิน")';
                          echo '</script>';
                        } else {
                            send_alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_normal");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_normal";
                                    </script>';
                          }
                        }
                    } else {
                        send_downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
                        if (empty ((int)$alternate)) {
                        } else {
                            send_alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_normal");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_normal";
                                    </script>';
                          }                     
                        }
                    }
                } else {
                    send_topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
                    if (empty ((int)$down_amount)) {
                        if (empty ((int)$alternate)) {
                        } else {
                            send_alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_normal");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_normal";
                                    </script>';
                          }
                        }
                    } else {
                        send_downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
                        if (empty ((int)$alternate)) {
                        } else {
                            send_alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_normal");
                          } else {
                              echo '<script type="text/javascript">
                                      window.location = "../main.php?page=keydata_normal";
                                    </script>';
                          }
                        }
                    }
                }                                   
        } elseif (strlen($input_number) == 3) {
            if (empty ((int)$top_amount)) {
                if (empty ((int)$down_amount)) {
                    if (empty ((int)$alternate)) {
                      echo '<script language="javascript">';
                      echo 'alert("กรุณาใส่จำนวนเงิน")';
                      echo '</script>';
                    } else {
                        send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
                    }
                } else {
                    send_3downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
                    if (empty ((int)$alternate)) {
                    } else {
                        send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
                    }
                }
            } else {
                send_3topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
                if (empty ((int)$down_amount)) {
                    if (empty ((int)$alternate)) {
                    } else {
                        send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
                    }
                } else {
                    send_3downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
                    if (empty ((int)$alternate)) {
                    } else {
                        send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
                    }
                }
            }                                   
    } else {
        echo '<script language="javascript">';
        echo 'alert("ตัวเลขไม่ถูกต้อง")';
        echo '</script>';
        }
    }    
  } else {
    // ใช้ค่าอินพุตก่อนหน้า หรือ ตั้งค่าเริ่มต้นหากไม่มีอยู่
    $input_number   = isset($_SESSION['last_number'])           ? $_SESSION['last_number'] : '';
    $top_amount     = isset($_SESSION['last_top_amount'])       ? $_SESSION['last_top_amount'] : '';
    $down_amount    = isset($_SESSION['last_down_amount'])      ? $_SESSION['last_down_amount'] : '';
    $alternate      = isset($_SESSION['last_alternate'])        ? $_SESSION['last_alternate'] : '';
    $dealer_id      = isset($_SESSION['last_select_dealer'])    ? $_SESSION['last_select_dealer'] : '';
  }
  // เก็บค่าที่ป้อนไว้ในตัวแปรเซสชันสำหรับคำขอถัดไป
  $_SESSION['last_number']        = $input_number;
  $_SESSION['last_top_amount']    = $top_amount;  
  $_SESSION['last_down_amount']   = $down_amount;  
  $_SESSION['last_alternate']     = $alternate;    
  $_SESSION['last_select_dealer'] = $dealer_id;

?>