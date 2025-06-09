<?php
$conn = mysqli_connect("localhost","root","","smarttech");
// semak sambungan jika gagal
if (!$conn){
    die("Sambungan Pangkalan Data Gagal" . mysqli_connect_error());
}
?>