<?php
session_start();
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
      $_SESSION['dealer_empty'] = "กรุณาเลือกคนเดินโพยหวย";
        if  (! headers_sent()) {
          header("Location: ../main.php?page=keydata_normal");
        } else {
            echo '<script type="text/javascript">
                    window.location = "../main.php?page=keydata_normal";
                  </script>';
        }
    } else {
        if (strlen($input_number) == 2) {

          if (empty ((int)$top_amount) && empty ((int)$down_amount) && empty ((int)$alternate)) {
            $_SESSION['amount_empty'] = "กรุณาใส่จำนวนเงิน";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_normal");
                            } else {
                                echo '<script type="text/javascript">
                                        window.location = "../main.php?page=keydata_normal";
                                      </script>';
                            }
          //ซื้อบนตัวเดียว                 
          } elseif (!empty ((int)$top_amount) && empty ((int)$down_amount) && empty ((int)$alternate)) {
            send_topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
            $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
          //ซื้อล่างตัวเดียว
          } elseif (empty ((int)$top_amount) && !empty ((int)$down_amount) && empty ((int)$alternate)) {
            send_downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
            $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
          //ซื้อโตดตัวเดียว
          } elseif (empty ((int)$top_amount) && empty ((int)$down_amount) && !empty ((int)$alternate)) {
            send_alternatedb_top($input_number, (int)$alternate, (int)$dealer_id); // call the function
            send_alternatedb_down($input_number, (int)$alternate, (int)$dealer_id); // call the function
            $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
          //ซื้อบนซื้อล่าง                 
        } elseif (!empty ((int)$top_amount) && !empty ((int)$down_amount) && empty ((int)$alternate)) {
          send_topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
          send_downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
        //ซื้อบนซื้อโตด
        } elseif (!empty ((int)$top_amount) && empty ((int)$down_amount) && !empty ((int)$alternate)) {
          send_topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
          send_alternatedb_top($input_number, (int)$alternate, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
        //ซื้อล่างซื้อโตด
        } elseif (empty ((int)$top_amount) && !empty ((int)$down_amount) && !empty ((int)$alternate)) {
          send_downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
          send_alternatedb_down($input_number, (int)$alternate, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
        //ซื้อทั้งหมด
        } elseif (!empty ((int)$top_amount) && !empty ((int)$down_amount) && !empty ((int)$alternate)) {
          send_topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
          send_downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
          send_alternatedb_top($input_number, (int)$alternate, (int)$dealer_id); // call the function
          send_alternatedb_down($input_number, (int)$alternate, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
                }                                   
        } elseif (strlen($input_number) == 3) {
          if (empty ((int)$top_amount) && empty ((int)$down_amount) && empty ((int)$alternate)) {
            $_SESSION['amount_empty'] = "กรุณาใส่จำนวนเงิน";
                            if  (! headers_sent()) {
                              header("Location: ../main.php?page=keydata_normal");
                            } else {
                                echo '<script type="text/javascript">
                                        window.location = "../main.php?page=keydata_normal";
                                      </script>';
                            }
          //ซื้อบนตัวเดียว                 
          } elseif (!empty ((int)$top_amount) && empty ((int)$down_amount) && empty ((int)$alternate)) {
            send_3topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
            $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
          //ซื้อล่างตัวเดียว
          } elseif (empty ((int)$top_amount) && !empty ((int)$down_amount) && empty ((int)$alternate)) {
            send_3downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
            $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
          //ซื้อโตดตัวเดียว
          } elseif (empty ((int)$top_amount) && empty ((int)$down_amount) && !empty ((int)$alternate)) {
            send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
            $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                        if  (! headers_sent()) {
                          header("Location: ../main.php?page=keydata_normal");
                      } else {
                          echo '<script type="text/javascript">
                                  window.location = "../main.php?page=keydata_normal";
                                </script>';
                      }
          //ซื้อบนซื้อล่าง                 
        } elseif (!empty ((int)$top_amount) && !empty ((int)$down_amount) && empty ((int)$alternate)) {
          send_3topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
          send_3downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
        //ซื้อบนซื้อโตด
        } elseif (!empty ((int)$top_amount) && empty ((int)$down_amount) && !empty ((int)$alternate)) {
          send_3topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
          send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
        //ซื้อล่างซื้อโตด
        } elseif (empty ((int)$top_amount) && !empty ((int)$down_amount) && !empty ((int)$alternate)) {
          send_3downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
          send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
        //ซื้อล่างซื้อโตด
        } elseif (!empty ((int)$top_amount) && !empty ((int)$down_amount) && !empty ((int)$alternate)) {
          send_3topdb($input_number, (int)$top_amount, (int)$dealer_id); // call the function
          send_3downdb($input_number, (int)$down_amount, (int)$dealer_id); // call the function
          send_3alternatedb($input_number, (int)$alternate, (int)$dealer_id); // call the function
          $_SESSION['save_empty'] = "บันทึกข้อมูลสำเร็จ";
                      if  (! headers_sent()) {
                        header("Location: ../main.php?page=keydata_normal");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "../main.php?page=keydata_normal";
                              </script>';
                    }
          } else {
            $_SESSION['save_empty'] = "ผิดพลาด";
          }
    } else {
      $_SESSION['num_empty'] = "ตัวเลขไม่ถูกต้อง";
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
    if  (! headers_sent()) {
      header("Location: ../main.php?page=keydata_normal");
    } else {
        echo '<script type="text/javascript">
                window.location = "../main.php?page=keydata_normal";
              </script>';
    }
  }
?>