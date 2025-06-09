<?php
    session_start();

    @$logout = $_GET["logout"];
    if ($logout){
        $_SESSION["tahapPengguna"] = "";
        session_destroy();
        header("location: login.php");
        die();
        #Jika pengguna logout, sesi dihentikan
        #Pengguna perlu login semula untuk mengakses laman web
    }

    @$kodItem = $_GET["kodItem"];
    @$banding = $_GET["banding"];
    
    $conn = mysqli_connect("localhost", "root", "", "smarttech");
    $query = "DELETE FROM item WHERE kodItem=$kodItem";
    $result = mysqli_query($conn, $query);
    header("location: edit.php?delete=1");
    #Delete item berjaya
?>