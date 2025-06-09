<?php
    session_start();

    $id = $_POST["IDPengguna"];
    $nama = $_POST["nama"];
    $password = $_POST["kataLaluan"];

    $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
    $query = "SELECT * FROM pelanggan where IDPelanggan='$id'";
    $result = mysqli_query($conn, $query);
    $query2 = "SELECT * FROM staf where IDStaf='$id'";
    $result2 = mysqli_query($conn, $query2);  
    #Menyemak sama ada IDPengguna yang dimasukkan sudah wujud atau tidak di jadual staf dan pelanggan

    if (!empty($row = mysqli_fetch_array($result)) || !empty($row2 = mysqli_fetch_array($result2))){
        header("location: signup.php?err=1");
        die();
        #Sign ini gagal kerana IDPengguna yang dimasukkan sudah wujud
    } else{
        $query = "INSERT INTO pelanggan VALUES ('$id', '$nama', '$password', 'A')";
        $result = mysqli_query($conn, $query);
        header("location: login.php?signin=1");
        die();
        #Sign in berjaya
    }
?>