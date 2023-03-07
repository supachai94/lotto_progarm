<?php
    session_start();
    require_once "../config/connect.php";
    if (isset($_POST['submit'])){
        $name = $_POST['name'];
        $discount = $_POST['discount'];

        $sql = $conn->prepare("INSERT INTO dealer(name, discount) VALUES(:name, :discount)");
        $sql->bindParam(":name", $name);
        $sql->bindParam(":discount", $discount);
        $sql->execute();

        if ($sql){
            $_SESSION['success'] = "บันทึกข้อมูลสำเร็จ";
            header("location: ../index.php?page=dealer");
        } else{
            $_SESSION['error'] = "บันทึกข้อมูลไม่สำเร็จ";
            header("location: ../index.php?page=dealer");

        }
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM dealer WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt){
            $_SESSION['success'] = "ข้อมูลถูกลบเรียบร้อบแล้ว";
            header("refresh:1; url=index.php?page=dealer");
        }
    }

    if (isset($_POST['update1'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $discount = $_POST['discount'];

        $sql = $conn->prepare("UPDATE dealer SET name = :name, discount = :discount WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name", $name);
        $sql->bindParam(":discount", $discount);
        $sql->execute();

        if ($sql){
            $_SESSION['success'] = "การเปลี่ยนแปลงข้อมูลสำเร็จ";
            header("location: index.php");
        } else{
            $_SESSION['error'] = "การเปลี่ยนแปลงข้อมูลไม่สำเร็จ";
            header("location: index.php");

        }
    }

?>