<?php
$conn = mysqli_connect("localhost", "root", "", "smarttech");

@$nFile = $_FILES["importfile"]["name"];
@$temp = $_FILES["importfile"]["tmp_name"];
if (filetype($nFile) != "file"){
    header("location: import.php?err=1");
    die();
}

move_uploaded_file($temp, $nFile);

$f = fopen($nFile, "r");
while($data = fgets($f)){
    $pengguna = explode("#", $data);
    $idpengguna = $pengguna[0];
    $namapengguna = $pengguna[1];
    $klpengguna = $pengguna[2];
    $taraf = $pengguna[3];

    $query = "SELECT * FROM pelanggan where IDPelanggan='$idpengguna'";
    $result = mysqli_query($conn, $query);
    $query2 = "SELECT * FROM staf where IDStaf='$idpengguna'";
    $result2 = mysqli_query($conn, $query2);  
    #Menyemak sama ada IDPengguna yang dimasukkan sudah wujud atau tidak di jadual staf dan pelanggan

    if (!empty($row = mysqli_fetch_array($result)) || !empty($row2 = mysqli_fetch_array($result2))){
        header("location: import.php?err=2'");
        die();
        #Import data gagal kerana IDPengguna yang dimasukkan sudah wujud
    }
    
    if(strlen($idpengguna) < 4 || strlen($idpengguna) > 4){
        header("location: import.php?err=3");
        die();
    }
    if(strlen($klpengguna)<8 || strlen($klpengguna)>16){
        header("location: import.php?err=4");
        die();
    }
    if(str_contains($taraf, "s") || str_contains($taraf, 'S')){
        $query = "INSERT INTO staf VALUES ('$idpengguna', '$namapengguna', '$klpengguna', 'A')";
    }else if(str_contains($taraf, "p") || str_contains($taraf, 'P')){
        $query = "INSERT INTO pelanggan VALUES ('$idpengguna', '$namapengguna', '$klpengguna', 'A')";
    }else{
        header("location: import.php?err=5");
        die();
    }
    $result = mysqli_query($conn, $query);
}

header("location: import.php?berjaya=1");
?>