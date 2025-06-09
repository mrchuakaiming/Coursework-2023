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
$conn = mysqli_connect("localhost", "root", "", "smarttech");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <a href="tambah.php" class="w3-bar-item w3-button w3-mobile w3-green">Tambah Item <i class="fa fa-plus" aria-hidden="true"></i></a>
            <a href="edit.php" class="w3-bar-item w3-button w3-mobile">Edit Item <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="tambahpengguna.php" class="w3-bar-item w3-button w3-mobile">Tambah Pengguna Baharu <i class="fa fa-address-card-o" aria-hidden="true"></i></a>
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
                echo"<a href='home.php' class='w3-bar-item w3-button w3-hover-yellow w3-right'>Kembali ke Menu Utama <i class='fa fa-angle-double-left' aria-hidden='true'></i></a>";
            }
            ?>
        </div>
        <div class="w3-twothird w3-container w3-margin-xxl" style="padding-left: 140px;">
                <h4 class="w3-bottombar w3-border-teal">Tambah Item Baharu <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="w3-row">
                <div class="w3-col m1">
                    &nbsp;
                </div>
                <div class="w3-col m10">
                <div class="w3-card-4 w3-margin">
                <form method="POST" action="additem.php" class="w3-form" enctype="multipart/form-data">
                    <div class="w3-container">
                        <div class="w3-row">
                            <div class="w3-col m5">
                                <br>
                                <label>Kod Item:</label>
                                <span class="w3-text-red">*4-digit nombor</span>
                                <input type="text" name="kodItem" class="w3-input w3-border" pattern="[0-9]{4}" oninvalid="this.setCustomValidity('Sila masukkan 4 digit nombor sahaja.')" oninput="this.setCustomValidity('')" placeholder="9999" required>
                                <br>
                                <label>Nama Item:</label>
                                <input type="text" name="namaItem" class="w3-input w3-border" required>
                                <br>
                                <label>Jenama:</label>
                                <select name="kodJenama" class="w3-input w3-border">
                                <?php
                                    $query = "SELECT * FROM jenama ORDER BY namaJenama";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)){
                                        $kJenama = $row["kodJenama"];
                                        $nJenama = $row["namaJenama"];
                                        echo "<option value='$kJenama'>$nJenama</option>";
                                    }
                                ?>
                                </select>
                                <br>
                                <label>Harga Item (RM):</label>
                                <input type="number" name="hargaItem" class="w3-input w3-border" pattern="[0-9]" oninvalid="this.setCustomValidity('Harga yang dimasukkan adalah nombor sahaja.')" oninput="this.setCustomValidity('')" placeholder="9999">
                                <br>
                            </div>
                            <div class="w3-col m1">
                                &nbsp;
                            </div>
                            <div class="w3-col m6">
                                <br>
                                <label>RAM:</label>
                                <select name="kodRAM" class="w3-input w3-border">
                                <?php
                                    $query = "SELECT * FROM ram ORDER BY RAM";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)){
                                        $kRAM = $row["kodRAM"];
                                        $RAM = $row["RAM"];
                                        echo "<option value='$kRAM'>$RAM GB</option>";
                                    }
                                ?>
                                </select>
                                <br>
                                <label>Storan Ingatan:</label>
                                <select name="kodStoranIngatan" class="w3-input w3-border">
                                <?php
                                    $query = "SELECT * FROM storaningatan ORDER BY storanIngatan";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)){
                                        $kstoran = $row["kodStoranIngatan"];
                                        $storan = $row["storanIngatan"];
                                        echo "<option value='$kstoran'>$storan GB</option>";
                                    }
                                ?>
                                </select>
                                <br>
                                <label>Kapasiti Bateri (mAh):</label>
                                <input type="number" name="kapasitiBateri" class="w3-input w3-border" pattern="[0-9]" oninvalid="this.setCustomValidity('Kapasiti bateri yang dimasukkan adalah nombor sahaja.')" placeholder="9999">
                                <br>
                                <label>Imej Item:</label>
                                <input type="file" name="imej" class="w3-input w3-border" required>
                                <br>
                                <button type="submit" value="hantar" class="w3-btn w3-blue" onclick="alert('Adakah anda pasti untuk menambah item ini?');">Hantar</button>
                                <a href="tambah.php" class="w3-btn w3-red">Reset</a>
                                <!--Papar borang tambah item baharu-->
                            </div>
                        </div>
                    </form>
                </div>

                <footer class="w3-container w3-teal">
                <h5>&copy; SmartTech</h5>
                </footer>

                <div class= "w3-col m1">
                    <?php
                    @$err = $_GET["err"];
                        if ($err==3){
                            echo"<script>alert('Tambah item berjaya.')</script>";
                        }else if ($err==1){
                            echo "<script>alert('Fail yang dimuat naik bukan gambar. Tambah item gagal. Sila cuba lagi.')</script>";
                        }else if ($err==2){
                            $kodItem = $_GET["kodItem"];
                            echo "<script>alert('$kodItem telah wujud. Tambah item gagal. Sila cuba lagi.')</script>";
                        }
                    ?>
                </div>
            </div>

                </div>
            </div>
            
        </div>
    </body>
</html>