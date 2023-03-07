<?php
session_start();
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
//เช็คว่ามีตัวแปร session อะไรบ้าง
//print_r($_SESSION);
//exit();
//สร้างเงื่อนไขตรวจสอบสิทธิ์การเข้าใช้งานจาก session
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
            echo '<script>
                setTimeout(function() {
                swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
                type: "error"
                }, function() {
                window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            exit();
}
?>

<main id="main" class="main">
    <section class="section dashboard">
    <!-- News & Updates Traffic -->
        <div class="card">
            <div class="card-body pb-0">
                <!-- Header -->
                <?php include("./header/header.php"); ?>
                <!-- Container -->
                <?php 
                switch ($_GET["page"]) {
                case "report":
                    //echo "report";
                    include("./page_report/page_report_total.php");
                    break;

                case "report_2":
                    //echo "report";
                    include("./page_report/page_report_2.php");
                    break;

                case "report_2_keep":
                    //echo "report";
                    include("./page_report/page_report_2_keep.php");
                    break;

                case "report_2_send":
                    //echo "report";
                    include("./page_report/page_report_2_send.php");
                    break;

                case "report_3":
                    //echo "report";
                    include("./page_report/page_report_3.php");
                    break;

                case "report_3_keep":
                    //echo "report";
                    include("./page_report/page_report_3_keep.php");
                    break;
    
                case "report_3_send":
                    //echo "report";
                    include("./page_report/page_report_3_send.php");
                    break;

                case "report_all":
                    //echo "report";
                    include("./page_report/page_report_all.php");
                    break;

                case "report_dealer":
                    //echo "report";
                    include("./page_report/page_report_dealer.php");
                    break;

                case "keydata":
                    //echo "Home -> Service";
                    include("./page_keydata/page_keydata_normal.php");
                    break;

                case "keydata_normal":
                    //echo "Home -> Service";
                    include("./page_keydata/page_keydata_normal.php");
                    break;

                case "keydata_all":
                    //echo "Home -> Service";
                    include("./page_keydata/page_all_keydata.php");
                    break;

                case "keydata_special_all":
                    //echo "Home -> Service";
                    include("./page_keydata/all_special_keydata.php");
                    break;

                case "keydata_special":
                    //echo "Home -> Service";
                    include("./page_keydata/page_keydata_special.php");
                    break;

                case "keep":
                    //echo "Home -> Product";
                    include("./page_keep/page_keep.php");
                    break;

                case "dealer":
                    //echo "Home -> About Us";
                    include("./page_dealer/page_dealer.php");
                    break;

                case "add_dealer":
                    //echo "Home -> About Us";
                    include("./page_dealer/page_dealer_add.php");
                    break;

                case "edit_dealer":
                    //echo "Home -> About Us";
                    include("./page_dealer/page_dealer_edit.php");
                    break;

                case "checklotto":
                    //echo "Home -> Contact Us";
                    include("./page_checklotto/page_checklotto.php");
                    break;

                case "results_lotto":
                    //echo "Home -> Contact Us";
                    include("./page_checklotto/results_lotto.php");
                    break;

                case "destroy":
                    //echo "Home -> Contact Us";
                    include("./page_checklotto/destroy_data.php");
                    break;

                case "change_password":
                    //echo "Home -> Contact Us";
                    include("./login/page_change_password.php");
                    break;
                    
                case "logout":
                    //echo "Home -> Contact Us";
                    session_destroy(); //เคลียร์ค่า session
                    if  (! headers_sent()) {
                        header("Location: index.php");
                    } else {
                        echo '<script type="text/javascript">
                                window.location = "index.php";
                            </script>';
                    }
                    break;

                default:
                    //echo "Home";
                    include("./page_report/page_report.php");
                }
                ?>

                <?php
                    if(isset($_GET["data"]) && isset($_GET["data2"]))
                    {
                        var_dump($_GET);
                        $data = $_GET["data"];
                        $data2 = $_GET["data2"];
                        

                    
                    }
                ?>


                <!-- Footer -->
                <?php include("./footer/footer.php"); ?>
            </div><!-- End Right side columns -->
        </div>
    </section>
</main>

