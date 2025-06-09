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
            <a href="home.php" class="w3-bar-item w3-button w3-mobile">Home <i class="fa fa-home"></i></a>
            <a href="banding.php" class="w3-bar-item w3-button w3-mobile">Perbandingan <i class="fa fa-arrows-h" aria-hidden="true"></i></a>
            <a href="carian.php" class="w3-bar-item w3-button w3-mobile w3-green">Carian <i class="fa fa-search" aria-hidden="true"></i></a>
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
                <div class="w3-bar-block w3-rightbar w3-border-blue w3-margin-right">
                    <form method="GET" class="w3-form w3-container">
                        <br>
                        <label>Kod Item:</label><span class="w3-text-red"> *4-digit</span>
                        <input type="number" name="kItem" class="w3-input w3-border">
                        <br>
                        <label>Nama Item:</label>
                        <input type="text" name="nItem" class="w3-input w3-border">
                        <br>
                        <label>Harga (RM):</label>
                        <select class="w3-border w3-margin-bottom" name="julatHarga">
                            <option value="hargaMax">Max</option>
                            <option value="hargaMin">Min</option>
                        </select>
                        <input type="text" name="hItem" class="w3-input w3-border w3-margin-bottom">
                        <label>Jenama:</label><br>
                        <select class="w3-border w3-margin-bottom w3-input" name="namaJenama">
                            <option value='*'>-</option>
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
                            $query = "SELECT * FROM jenama";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)){
                                $kJenama = $row["kodJenama"];
                                $nJenama = $row["namaJenama"];

                                echo"<option value='$kJenama'>$nJenama</option>";
                            }
                            ?>
                        </select>
                        <label>RAM:</label><br>
                        <select class="w3-border w3-margin-bottom w3-input" name="RAM">
                            <option value='*'>-</option>
                            <?php
                            $query = "SELECT * FROM ram";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)){
                                $kRAM = $row["kodRAM"];
                                $RAM = $row["RAM"];

                                echo"<option value='$kRAM'>$RAM GB</option>";
                            }
                            ?>
                        </select>
                        <label>Storan Ingatan:</label>
                        <select class="w3-border w3-margin-bottom w3-input" name="storanIngatan">
                            <option value='*'>-</option>
                            <?php
                            $query = "SELECT * FROM storaningatan";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)){
                                $kstoran = $row["kodStoranIngatan"];
                                $storan = $row["storanIngatan"];

                                echo"<option value='$kstoran'>$storan GB</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" value="Cari" class="w3-btn w3-blue">Cari</button>
                        <a href="carian.php" class="w3-btn w3-red">Reset</a>
                        </form>
                        <form method="GET" action="banding.php">
                            <table class="w3-margin-right w3-margin-top">
                                <tr>
                                <th>Bandingan</th></tr>
                                <tr>
                                <th>Item 1</th><td><input type="number" class="w3-input w3-border" name="banding1" id="banding1" value=""></td></tr>
                                <th>Item 2</th><td><input type="number" class="w3-input w3-border" name="banding2" id="banding2" value=""></td></tr>
                                <th>Item 3</th><td><input type="number" class="w3-input w3-border" name="banding3" id="banding3" value=""></td></tr>
                                </tr>
                                <tr>
                                <td><input type="submit" class="w3-btn w3-cyan" value="Banding"></td>
                                <td><button type="button" class="w3-btn w3-highway-red" onclick="padam();">Padam</button></td>
                                </tr>
                            </table>
                        </form>
                </div>
            </div>
            <div class="w3-col m10">
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
                $query = "SELECT COUNT(*) FROM item";
                $result = mysqli_query($conn, $query);
                while($row=mysqli_fetch_array($result)){
                    $count = $row["COUNT(*)"];
                }
                echo"<h4 class='w3-bottombar w3-border-teal'>Carian <i class='fa fa-search' aria-hidden='true'></i>
                <span style='float: right; font-size: 20px;' class='w3-margin-right'>Terdapat jumlah <b>$count</b> item dalam senarai item <i class='fa fa-book' aria-hidden='true'></i></span></h4>";
                #Papar jumlah item yang terdapat dalam jadual item
                $count=0;
                $query2="";
                @$kCarian = $_GET["kItem"];
                if (!isset($kCarian) || empty($kCarian)) {$kCarian = "";}
                @$iCarian = $_GET["nItem"];
                if (!isset($iCarian) || empty($iCarian)) {$iCarian = "";}
                @$hCarian = $_GET["hItem"];
                if (!isset($hCarian)|| empty($hCarian)) {$hCarian = 99999;}
                @$jCarian = $_GET["julatHarga"];
                if (!isset($jCarian) || empty($jCarian)) {$jCarian = "";}
                #Kriteria carian yang tidak dinyatakan oleh pengguna akan dibiarkan
                @$jenamaCarian = $_GET["namaJenama"];
                @$RAMCarian = $_GET["RAM"];
                @$storanCarian = $_GET["storanIngatan"];
                $query = "SELECT kodItem, namaItem, hargaItem, kapasitiBateri, namaJenama, storanIngatan, RAM, imej FROM item
                          join jenama on item.kodJenama=jenama.kodJenama
                          join storaningatan on item.kodStoranIngatan=storaningatan.kodStoranIngatan
                          join ram on item.kodRAM=ram.kodRAM";
                if ($jCarian == "hargaMax"){
                    $query = $query . " WHERE namaItem like '%$iCarian%' and hargaItem<=$hCarian";
                    $query2 = $query2 . " WHERE namaItem like '%$iCarian%' and hargaItem<=$hCarian";
                    #Jika pengguna memilih harga maximum dalam carian
                    }
                if ($jCarian == "hargaMin"){
                    $query = $query . " WHERE namaItem like '%$iCarian%' and hargaItem>=$hCarian";
                    $query2 = $query2 . " WHERE namaItem like '%$iCarian%' and hargaItem>=$hCarian";
                    #Jika pengguna memilih harga manimum dalam carian
                    }
                if (isset($kCarian) || !empty($kCarian)){
                    if ($kCarian !=""){
                        $query = $query . " and kodItem=$kCarian";
                        $query2 = $query2 . " and kodItem=$kCarian";
                    }
                    #Jika pengguna menyatakan kodItem yang khusus untuk dicari
                }
                if (isset($jenamaCarian) || !empty($jenamaCarian)){
                    if ($jenamaCarian !="*"){
                        $query = $query . " and item.kodJenama='$jenamaCarian'";
                        $query2 = $query2 . " and item.kodJenama='$jenamaCarian'";
                    }
                    #Jika pengguna menyatakan nama jenama yang khusus untuk dicari
                }
                if (isset($RAMCarian) || !empty($RAMCarian)){
                    if ($RAMCarian !="*"){
                        $query = $query . " and item.kodRAM='$RAMCarian'";
                        $query2 = $query2 . " and item.kodRAM='$RAMCarian'";
                    }
                    #Jika pengguna menyatakan RAM yang khusus untuk dicari
                }
                if (isset($storanCarian) || !empty($storanCarian)){
                    if ($storanCarian !="*"){
                        $query = $query . " and item.kodStoranIngatan='$storanCarian'";
                        $query2 = $query2 . " and item.kodStoranIngatan='$storanCarian'";
                    }
                    #Jika pengguna menyatakan storan ingatan yang khusus untuk dicari
                }
                
                $result = mysqli_query($conn, $query);

                if (!empty($iCarian) || !empty($jCarian) || !empty($jenamaCarian) || !empty($RAMCarian) || !empty($storanCarian)){
                    $query3 = "SELECT COUNT(*) FROM item";
                    $query3 = $query3 . $query2;
                    $result2 = mysqli_query($conn, $query3);
                    while ($row=mysqli_fetch_array($result2)){
                        $count = $row["COUNT(*)"];
                        if ($count != 0){
                            echo"<div class='w3-panel w3-pale-green w3-leftbar w3-border-green'>
                            <p>Terdapat <b>$count</b> item dijumpai dalam carian ini. ";
                            if(!empty($kCarian)){
                                echo"<span class='w3-tag w3-pink w3-small w3-round-xlarge'>Kod Item = $kCarian</span>";
                            }
                            if(!empty($iCarian)){
                                echo"<span class='w3-tag w3-orange w3-small w3-round-xlarge'>Nama Item = $iCarian</span>";
                            }
                            if($hCarian < 99999){
                                echo"<span class='w3-tag w3-yellow w3-small w3-round-xlarge'>$jCarian Item = $hCarian</span>";
                            }
                            if($jenamaCarian != "*"){
                                echo"<span class='w3-tag w3-green w3-small w3-round-xlarge'>Jenama = $jenamaCarian</span>";
                            }
                            if($RAMCarian != "*"){
                                echo"<span class='w3-tag w3-blue w3-small w3-round-xlarge'>RAM = $RAMCarian</span>";
                            }
                            if($storanCarian != "*"){
                                echo"<span class='w3-tag w3-purple w3-small w3-round-xlarge'>Storan Ingatan = $storanCarian</span>";
                            }
                            echo"</p></div>";
                        }     
                }
                #Mencari bilangan item yang dapat dijumpai
                }
                $counter=0;
                
                while ($row=mysqli_fetch_array($result)){
                    $counter++;
                    $kItem = $row["kodItem"];
                    $nItem = $row["namaItem"];
                    $harga = $row["hargaItem"];
                    $bateri = $row["kapasitiBateri"];
                    $jenama = $row["namaJenama"];
                    $sIngatan = $row["storanIngatan"];
                    $ram = $row["RAM"];
                    $image = $row["imej"];

                    if ($counter%3==1){
                        echo "<div class='w3-row'>";
                    }

                    echo "<div class='w3-col m4'>
                          <img src='image/$image' class='w3-image'>
                          <h3>$nItem [$kItem]</h3>
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
                          </div>";

                          if($counter%3==0 && $counter !=0){
                            echo "</div>";
                        }
                }

                if ($counter%3 !=0){
                    echo"</div>";
                    #Papar carian
                }

                if ($counter==0){
                    echo"<div class='w3-panel w3-pale-red w3-leftbar w3-border-red'>
                    <p>Minta maaf. Tiada item dijumpai. Sila cuba lagi.</p>
                    </div>";
                    #Tiada item dijumpai akan mengeluarkan mesej untuk pengguna
                }

                ?>
            
                </div>
            </div>            
        </div>
        </div>  
    </div>  
    </body>
</html>