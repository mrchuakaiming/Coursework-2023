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

    @$idpengguna = $_GET["pengguna"];
    $conn = mysqli_connect("localhost", "root", "", "smarttech");
    $query = "SELECT * FROM staf WHERE IDStaf='$idpengguna'"; 
    $result = mysqli_query($conn, $query);

    if (empty($row = mysqli_fetch_array($result))){
        $query = "UPDATE pelanggan SET stat='D' WHERE IDPelanggan='$idpengguna'";
        $result = mysqli_query($conn, $query);
        header("location: tambahpengguna.php?delete=1");
        die();
        #Jika IDPengguna yang perlu dipadamkan tidak wujud dalam jadual staf, maka IDPengguna tersebut berada di jadual pelanggan
    }else{
        $query = "UPDATE staf SET stat='D' WHERE IDStaf='$idpengguna'";
        $result = mysqli_query($conn, $query);
        header("location: tambahpengguna.php?delete=1");
        die();
        #IDPengguna wujud di jadual staf
    }

?>