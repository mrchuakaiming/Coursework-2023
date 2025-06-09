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

    @$idpengguna = $_POST["idpengguna"];
    @$npengguna = $_POST["nama"];
    @$klpengguna = $_POST["kl"];
    @$taraf = $_POST["tarafpengguna"];
    @$stat = $_POST["status"];

    echo "<form method='POST' action='check.php'>";
        if ($stat == 'D'){
            echo "<input type='hidden' name='status' value='$stat'>";}
    echo "</form>";

    $conn = mysqli_connect("localhost", "root", "", "smarttech");

    $query = "SELECT * FROM staf where IDStaf='$idpengguna'";
    #Menyemak sama ada IDPengguna tersebut berada di jadual staf atau pelanggan

    $result = mysqli_query($conn, $query);

    if (empty($row=mysqli_fetch_array($result))){
        if ($taraf=="staf"){
            $query = "DELETE FROM pelanggan WHERE IDPelanggan='$idpengguna'";
            $result = mysqli_query($conn, $query);
            $query = "INSERT INTO staf VALUES ('$idpengguna', '$npengguna', '$klpengguna', '$stat')";
            $result = mysqli_query($conn, $query);
            #Delete IDPelanggan dan masukkan dalam jadual staf untuk pertukaran taraf dari pelanggan ke staf
        }else{
            $query = "UPDATE pelanggan SET 
                namaPelanggan='$npengguna',
                kataLaluanPelanggan='$klpengguna',
                stat='$stat'
                WHERE IDPelanggan='$idpengguna'";
            $result = mysqli_query($conn, $query);
            #Tiada perubahan taraf pengguna
        }
         
    }else{
        if ($taraf=="pelanggan"){
            $query = "DELETE FROM staf WHERE IDStaf='$idpengguna'";
            $result = mysqli_query($conn, $query);
            $query = "INSERT INTO pelanggan VALUES ('$idpengguna', '$npengguna', '$klpengguna', '$stat')";
            $result = mysqli_query($conn, $query);
            #Delete IDStaf dan masukkan dalam jadual pelanggan untuk pertukaran taraf dari staf ke pelanggan
        }else{
            $query = "UPDATE staf SET 
                namaStaf='$npengguna',
                kataLaluanStaf='$klpengguna',
                stat='$stat'
                WHERE IDStaf='$idpengguna'";
            $result = mysqli_query($conn, $query);
            #Tiada perubahan taraf pengguna
        }
    }
    
    header("location: tambahpengguna.php?kk=1");
    die();

?>