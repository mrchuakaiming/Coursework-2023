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

            function count (namaItem) {
                bilBanding ++;

                if (bilBanding > 3) {
                    alert("Hanya boleh banding 3 item sahaja. Sila tekan BANDING untuk perbandingan.");
                    return false;
                }else{
                    alert("Item ["+namaItem+"] berjaya ditambah ke senarai perbandingan.");
                }

                if (bilBanding == 1) {
                    document.getElementById("banding1").value = namaItem;
                }
                if (bilBanding == 2) {
                    document.getElementById("banding2").value = namaItem;
                }
                if (bilBanding == 3) {
                    document.getElementById("banding3").value = namaItem;
                }
                /*Ubah nilai dalam input kepada pilihan pengguna untuk bandingan*/
            }

            function padam() {
                bilBanding = 0;
                document.getElementById("banding1").value = "";
                document.getElementById("banding2").value = "";
                document.getElementById("banding3").value = "";
                /*Reset pilihan bandingan*/
            }

        </script>
    </head>
    <body id="title">
    <div class="w3-bar w3-blue">
    <a href="home.php" class="w3-bar-item w3-button w3-mobile w3-green">Home <i class="fa fa-home"></i></a>
            <a href="banding.php" class="w3-bar-item w3-button w3-mobile">Perbandingan <i class="fa fa-arrows-h" aria-hidden="true"></i></a>
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
        <div class="w3-container">
            <form method="GET" action="banding.php">
                <table class="w3-margin-left w3-margin-right">
                    <tr>
                        <th>Item 1</th><td><input type="number" class="w3-input w3-border" name="banding1" id="banding1" value=""></td>
                        <th>Item 2</th><td><input type="number" class="w3-input w3-border" name="banding2" id="banding2" value=""></td>
                        <th>Item 3</th><td><input type="number" class="w3-input w3-border" name="banding3" id="banding3" value=""></td>
                        <td><input type="submit" class="w3-btn w3-cyan" value="Banding"></td>
                        <td><button type="button" class="w3-btn w3-highway-red" onclick="padam();">Padam</button></td>
        </tr>
        </table>

        </form>
        </div>
            <div class="w3-twothird w3-container">
            </div>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
                    $query = "SELECT * FROM item";
                    $result = mysqli_query($conn, $query);
                    $count = 0;
                    while ($row = mysqli_fetch_array($result)){$count++;}
                    echo"<h4 class='w3-bottombar w3-border-teal w3-margin'>Senarai Item <i class='fa fa-search' aria-hidden='true'></i> 
                <span style='float: right; font-size: 20px;' class='w3-margin-right'>Terdapat jumlah <b>$count</b> item dalam senarai item <i class='fa fa-book' aria-hidden='true'></i></span></h4>";
                ?>
            </div>
        </div>
        </div>
          </div>
                <form method="POST" action="banding.php">
                 <?php
                $count=0;
                $query = "SELECT kodItem, namaItem, hargaItem, kapasitiBateri, namaJenama, storanIngatan, RAM, imej FROM item
                          join jenama on item.kodJenama=jenama.kodJenama
                          join storaningatan on item.kodStoranIngatan=storaningatan.kodStoranIngatan
                          join ram on item.kodRAM=ram.kodRAM
                          ORDER BY kodItem";
                $result = mysqli_query($conn, $query);
                while ($row=mysqli_fetch_array($result)){
                    $count++;
                    $kItem = $row["kodItem"];
                    $nItem = $row["namaItem"];
                    $harga = $row["hargaItem"];
                    $bateri = $row["kapasitiBateri"];
                    $jenama = $row["namaJenama"];
                    $sIngatan = $row["storanIngatan"];
                    $ram = $row["RAM"];
                    $image = $row["imej"];

                    if ($count%4==1){
                        echo "<div class='w3-row'>";
                    }

                    echo "<div class='w3-col m3 w3-padding-large'>
                          <img src='image/$image' class='w3-image'>
                          <h3>$nItem [$kItem]</h3>
                          <input type='hidden' name='kItem' value=$kItem>
                          <table class='w3-table'>
                          <tr>
                          <th class='w3-pale-green'>Harga:</th>
                          <td>RM$harga</td>
                          </tr>
                          <th class='w3-pale-green'>Nama Jenama:</th>
                          <td>$jenama</td>
                          </tr>
                          <tr>
                          <th class='w3-pale-green'>Kapasiti Bateri:</th>
                          <td>$bateri mAh</td>
                          </tr>
                          <tr>
                          <tr>
                          <th class='w3-pale-green'>Storan Ingatan:</th>
                          <td>$sIngatan GB</td>
                          </tr>
                          <tr>
                          <th class='w3-pale-green'>RAM:</th>
                          <td>$ram GB</td>
                          </tr>
                          <tr>
                          </table>
                          <button type='button' class='w3-btn w3-pink' onclick='count($kItem)'>Banding</button>
                          </div>
                          ";

                          if($count%4==0 && $count !=0){
                            echo "</div>";
                        }
                }

                if ($count%4 !=0){
                    echo"</div>";
                }
                echo"</form>";
                #Papar senarai item
                
                @$signin = $_GET["signin"];
                    if ($signin == 1){echo "<script>alert('Login berjaya.')</script>";}
                ?>
                </div>
            </div>            
        </div>
        </div>  
            </div>
    </div>
    </body>
</html>