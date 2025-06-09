<?php
    session_start();

    @$logout = $_GET["logout"];
    if ($logout){
        $_SESSION["tahapPengguna"] = "";
        session_destroy();
        header("location: login.php");
        die();
        #Jika pengguna logout, sesi dihentikan
        #Pengguna perlu login semula jika ingin mengakses laman web
    }

    @$idpengguna = $_POST["IDPengguna"];
    @$katalaluan = $_POST["kataLaluan"];
    #Mendapatkan IDPengguna dan kataLaluan daripada login.php

    $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
    $queryStaf = "SELECT * FROM staf where IDStaf='$idpengguna' and kataLaluanStaf='$katalaluan'";
    $queryPelanggan = "SELECT * FROM pelanggan where IDPelanggan='$idpengguna' and kataLaluanPelanggan='$katalaluan'";
    $resultStaf = mysqli_query($conn, $queryStaf);
    $resultPelanggan = mysqli_query($conn, $queryPelanggan);

    if ($row = mysqli_fetch_array($resultStaf)){
        #Jika pengguna yang daftar masuk ialah staf, IDPengguna dan kataLaluan ada di jadual staf dan bukan di jadual pelanggan
        $nama = $row["namaStaf"];
        $stat = $row["stat"];
        if($stat == "A"){
            $_SESSION["tahapPengguna"]= 1;
            #Tahap pengguna ialah staf, staf boleh akses admin portal
            header("location: home.php?signin=1");
            #Signin berjaya
        }else{
            $stat = "";
            session_destroy();
            header("location: login.php?err=3");
            die();
            #Pengguna yang dipadam yang ingin login akan ditolak
        }
        
    } else if ($row = mysqli_fetch_array($resultPelanggan)){
        #Jika pengguna yang daftar masuk ialah pelanggan,  IDPengguna dan kataLaluan ada di jadual pelanggan dan bukan di jadual staf
        $nama = $row["namaPelanggan"];
        $stat = $row["stat"];
        if($stat == "A"){
            $_SESSION["tahapPengguna"]= "";
            #Tahap pengguna ialah pelanggan, pelanggan tidak boleh akses admin portal
            header("location: home.php?signin=1");
            #Signin berjaya
        }else{
            $stat = "";
            session_destroy();
            header("location: login.php?err=3");
            die();
            #Pengguna yang dipadam yang ingin login akan ditolak
        }
        
    } else {
        header("location: login.php?err=1");
        die();
        #IDPengguna dan kataLaluan yang sepadan tidak dapat dijumpai dalam jadual staf dan pelanggan
        #Login gagal
    }
    
    $_SESSION["idPengguna"] = $idpengguna;
    $_SESSION["namaPengguna"] = $nama;
    $_SESSION["kataLaluan"] = $katalaluan;

    $status = $_POST["status"];
    $_SESSION["status"] = $stat;
?>