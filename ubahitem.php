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
    }

    $kItem = $_POST["kod"];
    $nItem = $_POST["nama"];
    $kJenama = $_POST["kodJenama"];
    $hItem = $_POST["harga"];
    $kRam = $_POST["kram"];
    $kStoran = $_POST["kStoran"];
    $kBateri = $_POST["bateri"];
    $nFile = $_FILES["imej"]["name"];
    
    if(isset($nFile) && !empty($nFile)){
        $fileLocation = "image/" . basename($nFile);
        $check = getimagesize($_FILES["imej"]["tmp_name"]);
        if (!$check) {
            header("location: edititem.php?err=1&&kodItem=$kItem");
            die();
            #Jika imej yang dimuat naik bukan format gambar, mesej ralat dipulangkan
        } 
        move_uploaded_file($_FILES["imej"]["tmp_name"], $fileLocation);
    }

    $query = "UPDATE item SET namaItem='$nItem', kodJenama='$kJenama', hargaItem=$hItem,
            kodRAM='$kRam', kodStoranIngatan='$kStoran', kapasitiBateri=$kBateri";
    if(empty($nFile)){
        $query = $query . " WHERE kodItem=$kItem";
        #Jika imej fail baharu tidak dimasukkan
    } else{
        $query = $query . ", imej='$nFile' WHERE kodItem=$kItem";
        #Jika imej fail baharu dimasukkan
    }
    
    $result = mysqli_query($conn, $query);
    header("location: edit.php?edit=1");
    die();
    #Edit item berjaya
?>
?>