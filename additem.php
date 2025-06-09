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

    if (empty($_POST)){
        header("location: tambah.php");
        die();
        #Jika tiada nilai dihantar ke additem.php, kembali ke tambah.php
    }

    $kItem = $_POST["kodItem"];
    $nItem = $_POST["namaItem"];
    $kJenama = $_POST["kodJenama"];
    $hItem = $_POST["hargaItem"];
    $kRam = $_POST["kodRAM"];
    $kStoran = $_POST["kodStoranIngatan"];
    $kBateri = $_POST["kapasitiBateri"];
    $idStaf = $_SESSION["idPengguna"];

    $nFile = $_FILES["imej"]["name"];
    $fileLocation = "image/" . basename($nFile);
    $check = getimagesize($_FILES["imej"]["tmp_name"]);
    if (!$check) {
        header("location: tambah.php?err=1");
        die();
        #Jika imej yang dimuat naik bukan format gambar, mesej ralat dipulangkan
    } 

    move_uploaded_file($_FILES["imej"]["tmp_name"], $fileLocation);

    $query = "SELECT kodItem FROM item where kodItem='$kItem'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_array($result)){
        header("location: tambah.php?err=2&&kodItem=$kItem");
        die();
        #Jika kodItem yang dimasukkan sudah wujud dalam jadual item, mesej ralat dipulangkan
    }

    $query = "INSERT INTO item VALUES(
                '$kItem', '$nItem', '$hItem', '$kBateri', '$kJenama', '$idStaf', '$kStoran', '$kRam', '$nFile'
            )";
    $result = mysqli_query($conn, $query);

    header("location: tambah.php?err=3");
    die();
    #Tambah item baharu berjaya
?>