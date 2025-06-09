<?php
session_start();
if (!isset($_SESSION["namaPengguna"])){
    header("location: login.php?err=2");
    die();
    #Jika pengguna ingin mengakses laman web dengan menyalin alamat laman web tanpa login akan dihalang
} else if (!isset($_SESSION["status"])){
    echo "<script>Akaun anda telah DIPADAM. Anda TIDAK DAPAT LOGIN sehingga akaun anda diaktifkan semula.</script>";
    session_destroy(); 
    header("location: login.php");
    die();
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-highway.css">
        <script>
            var size = 3;
            var bilBanding = 0;

            function setFont() {
                var fSize = getFont(size);
                document.getElementById("title").classList.add(fSize);
                /*Tambah class CSS baharu untuk font saiz yang lebih besar atau kecil*/
            }

            function getFont(size) {
                switch (size){
                    case 1: 
                        return "w3-small"; break;
                     case 2: 
                        return "w3-medium"; break;
                     case 3: 
                        return "w3-large"; break;
                    case 4: 
                        return "w3-xlarge"; break;
                     case 5: 
                        return "w3-xxlarge"; break; 
                     }
                /*Dapatkan font saiz semasa*/                                                                                            
            }

            function increaseFont () {
                var fSize = getFont(size);
                document.getElementById("title").classList.remove(fSize);
                /*Memadam CSS font saiz sebelum ini*/

                size++;
                if (size >5) { size = 5; }
                setFont();
                /*Jika saiz lebih daripda maximum, font saiz ditetapkan kepada saiz maximum*/
            }

            function decreaseFont () {
                var fSize = getFont(size);
                document.getElementById("title").classList.remove(fSize);

                size--;
                if (size<1) { size = 1; }
                setFont();
                /*Jika saiz kurang daripda minimum, font saiz ditetapkan kepada saiz minimum*/
            }
        </script>
    </head>
    <body id="title">
        <div class="w3-bar w3-blue">
        <a href="home.php" class="w3-bar-item w3-button w3-mobile">Home <i class="fa fa-home"></i></a>
            <a href="banding.php" class="w3-bar-item w3-button w3-mobile w3-green">Perbandingan <i class="fa fa-arrows-h" aria-hidden="true"></i></a>
            <a href="carian.php" class="w3-bar-item w3-button w3-mobile">Carian <i class="fa fa-search" aria-hidden="true"></i></a>
            <a href="hubungi.php" class="w3-bar-item w3-button w3-mobile">Hubungi Kami <i class="fa fa-phone"></i></a>
            <button class="w3-button w3-pink" onclick="window.print()">Cetak</button>
            <div class="w3-dropdown-hover">
            <button class="w3-button w3-teal">Font Size</button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="#" class="w3-bar-item w3-button" onclick="increaseFont();">+</a>
                <a href="#" class="w3-bar-item w3-button" onclick="decreaseFont();">-</a>
            </div></div>
            <a href="check.php?logout=1" class="w3-bar-item w3-button w3-hover-red w3-right">Logout [
                <?php echo $_SESSION["namaPengguna"];?> ]
            <i class="fa fa-user"></i></a>
            <?php
            if (!empty($_SESSION["tahapPengguna"])){
                echo"<a href='tambah.php' class='w3-bar-item w3-button w3-yellow w3-right'>Admin Portal <i class='fa fa-desktop' aria-hidden='true'></i></a>";
            }
            ?>
        </div>
        <div class="w3-row">
            <div class="w3-col m2">
                &nbsp;
            </div>
            <div class="w3-col m8">
            <div class="w3-col m7 w3-margin-left w3-margin-right">
                <h4 class='w3-bottombar w3-border-teal'>Perbandingan <i class="fa fa-arrows-h" aria-hidden="true"></i> 
            </div>
                <table class="w3-border w3-table w3-striped">
                    <thread>
                        <tr class="w3-highway-blue">
                            <th>Kod Item</th>
                            <th>Nama Item</th>
                            <th>Keterangan</th>
                            <th>Imej</th>
                        </tr>
                    </thread>
                    <?php
                        @$item1 = $_GET["banding1"];
                        @$item2 = $_GET["banding2"];
                        @$item3 = $_GET["banding3"];
                        if (empty($item1)){
                            echo "</table><div class='w3-panel w3-pale-red w3-leftbar w3-border-red'>
                            <p>Pilih item di HOME atau CARIAN dan tekan BANDING di laman yang sama untuk melakukan perbandingan.</p>
                            </div>";
                            die();
                        }
                        $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
                        if(!empty($item1)){
                            $query = "SELECT kodItem, namaItem, hargaItem, kapasitiBateri, namaJenama, storanIngatan, RAM, imej FROM item
                                    join jenama on item.kodJenama=jenama.kodJenama
                                    join storaningatan on item.kodStoranIngatan=storaningatan.kodStoranIngatan
                                    join ram on item.kodRAM=ram.kodRAM
                                    WHERE kodItem=$item1";
                            if(!empty($item2)){
                            $query = $query . " OR kodItem=$item2";
                                if(!empty($item3)){
                                    $query = $query . " OR kodItem=$item3";
                                }
                            }
                            $query = $query . " ORDER BY kodItem";
                        }
                        $result = mysqli_query($conn, $query);
                        while ($row=mysqli_fetch_array($result)){
                            $kItem = $row["kodItem"];
                            $nItem = $row["namaItem"];
                            $jenama = $row["namaJenama"];
                            $harga = $row["hargaItem"];
                            $bateri = $row["kapasitiBateri"];
                            $sIngatan = $row["storanIngatan"];
                            $ram = $row["RAM"];
                            $image = $row["imej"];

                            echo "<tr><td>$kItem</td>
                            <td>$nItem</td>
                            <td><b>Jenama:</b> $jenama<br><b>Harga:</b> RM$harga<br><b>Kapasiti Bateri:</b><br> $bateri mAh<br><b>Storan Ingatan:</b><br> $sIngatan GB<br><b>RAM:</b> $ram GB<br></td>
                            <td><img src='image/$image' height='170px'></td>";

                            #Papar item yang dipilih untuk bandingan
                        }
                    ?>
                </table>
            </div>
            <div class="w3-col m2">
                &nbsp;
            </div>
        </div>