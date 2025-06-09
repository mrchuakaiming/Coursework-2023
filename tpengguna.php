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
    
    $conn = mysqli_connect("localhost", "root", "", "smarttech");

    $idpengguna = $_POST["idpengguna"];
    $npengguna = $_POST["namapengguna"];
    $ps = $_POST["kl"];
    $taraf = $_POST["tarafpengguna"];

    $query = "SELECT * FROM staf WHERE IDStaf='$idpengguna'";
    $result = mysqli_query($conn, $query);
    $query2 = "SELECT * FROM pelanggan WHERE IDPelanggan='$idpengguna'";
    $result2 = mysqli_query($conn, $query);
    if (!empty($row = mysqli_fetch_array($result)) || !empty($row2 = mysqli_fetch_array($result2))){
        header("location: tambahpengguna.php?err=1");
        die();
        #Tambah pengguna baharu gagal kerana IDPengguna yang dimasukkan sudah wujud
    }else{
        $query = "INSERT INTO $taraf VALUES
            ('$idpengguna', '$npengguna', '$ps', 'A')";
        $result = mysqli_query($conn, $query);
        header("location: tambahpengguna.php?baru=1");
        die();
        #Tambah pengguna baharu berjaya
    }

    
?>