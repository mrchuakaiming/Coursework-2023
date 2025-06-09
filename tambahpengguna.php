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

            function errmsg(){
                var ans = confirm("Adakah anda pasti untuk delete pengguna ini?");
                return ans;
                /*Mesej pengesahan untuk delete*/
            }
        </script>
    </head>
    <body id="title">
    <div class="w3-bar w3-blue">
            <a href="tambah.php" class="w3-bar-item w3-button w3-mobile">Tambah Item <i class="fa fa-plus" aria-hidden="true"></i></a>
            <a href="edit.php" class="w3-bar-item w3-button w3-mobile">Edit Item <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="tambahpengguna.php" class="w3-bar-item w3-button w3-mobile w3-green">Tambah Pengguna Baharu <i class="fa fa-address-card-o" aria-hidden="true"></i></a>
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
            <div class="w3-row">
            </div>
            </div>
                <?php
                @$delete = $_GET["delete"];
                @$baru = $_GET["baru"];
                @$kk = $_GET["kk"];
                @$err = $_GET["err"];
                if ($delete == 1){
                    echo"<script>alert('Delete pengguna berjaya!')</script>";
                }
                if ($baru == 1){
                    echo"<script>alert('Tambah pengguna baru berjaya!')</script>";
                }
                if ($kk == 1){
                    echo"<script>alert('Kemas kini pengguna berjaya!')</script>";
                }
                if ($err == 1){
                    echo"<script>alert('Tambah pengguna baharu gagal kerana IDPengguna yang dimasukkan telah wujud. Sila cuba lagi.')</script>";
                }
                ?>
                <div class="w3-col m7 w3-padding-small">
                    <div class="w3-twothird w3-container">
                    <?php
                        $query = "SELECT COUNT(*) FROM staf";
                        $query2 = "SELECT COUNT(*) FROM pelanggan";
                        $result = mysqli_query($conn, $query);
                        $result2 = mysqli_query($conn, $query2);
                        while ($row = mysqli_fetch_array($result)){
                            $bilStaf = $row["COUNT(*)"];
                        }
                        while ($row2 = mysqli_fetch_array($result2)){
                            $bilPlg = $row2["COUNT(*)"];
                        }
                        $jum = $bilStaf + $bilPlg;
                        echo"<h4 class='w3-bottombar w3-border-teal'>Senarai Pengguna <i class='fa fa-address-book-o' aria-hidden='true'></i>
                            <span style='float: right; font-size: 20px;' class='w3-margin-right'>Jumlah pengguna = <b>$jum</b> <i class='fa fa-book' aria-hidden='true'></i></span></h4>";
                    ?>
                    </div>
                    <table class="w3-border w3-table w3-striped">
                        <thread>
                            <tr class="w3-green">
                                <th>Bil.</th>
                                <th>IDPengguna</th>
                                <th>Nama</th>
                                <th>KataLaluan</th>
                                <th>Taraf</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thread>    
                    <?php
                        $num=1;
                        $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
                        $query = "SELECT * FROM staf";
                        $result = mysqli_query($conn, $query);
                        $bil=0;
                        while ($row=mysqli_fetch_array($result)){
                            $bil++;
                            $idstaf = $row["IDStaf"];
                            $nstaf = $row["namaStaf"];
                            $klstaf = $row["kataLaluanStaf"];
                            $stat = $row["stat"];

                            if($stat == "A"){
                                $class = "black";
                            }else{
                                $class = "red";
                            }

                            echo "<tr><td class='w3-text-$class'>$bil</td>
                                <td class='w3-text-$class'>$idstaf</td>
                                <td class='w3-text-$class'>$nstaf</td>
                                <td class='w3-text-$class'>$klstaf</td>
                                <td class='w3-text-$class'>Staf</td>
                                <td class='w3-text-$class'>$stat</td>
                                <td><a href='kemaskinipengguna.php?pengguna=$idstaf'>Kemas Kini <i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                <a href='#'>
                                <form method='GET' action='deletepengguna.php' style='margin: 0 0 0 0;' onsubmit='return errmsg();'>
                                <input type='hidden' name='pengguna' value='$idstaf'>
                                <input type='submit' class='w3-text-red' value='Delete'><i class='fa fa-trash-o w3-text-red' aria-hidden='true'></i></form></a></td></tr>";
                        }

                        $query = "SELECT * FROM pelanggan";
                        $result = mysqli_query($conn, $query);
                        while ($row=mysqli_fetch_array($result)){
                            $bil++;
                            $idpelanggan = $row["IDPelanggan"];
                            $npelanggan = $row["namaPelanggan"];
                            $klpelanggan = $row["kataLaluanPelanggan"];
                            $stat = $row["stat"];

                            if($stat == "A"){
                                $class = "black";
                            }else{
                                $class = "red";
                            }

                            echo "<tr><td width='80px' height='50px' class='w3-text-$class'>$bil</td>
                                <td class='w3-text-$class'>$idpelanggan</td>
                                <td class='w3-text-$class'>$npelanggan</td>
                                <td class='w3-text-$class'>$klpelanggan</td>
                                <td class='w3-text-$class'>Pelangggan</td>
                                <td class='w3-text-$class'>$stat</td>
                                <td><a href='kemaskinipengguna.php?pengguna=$idpelanggan'>Kemas Kini <i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                <a href='#'>
                                <form method='GET' action='deletepengguna.php' style='margin: 0 0 0 0;' onsubmit='return errmsg();'>
                                <input type='hidden' name='pengguna' value='$idpelanggan'>
                                <input type='submit' class='w3-text-red' value='Delete'><i class='fa fa-trash-o w3-text-red' aria-hidden='true'></i></form></a></td></tr>";
                            
                        }
                        #Papar borang senarai pengguna
                        ?>
                        </table>
                        <table>
                        <tr>
                            <td colspan='6'>
                                <a class='w3-btn w3-pink' href='penggunabaru.php'>Tambah Pengguna Baru</a>
                            </td>
                        </tr>
                        </table>
                </div>
                </div>
                </div>
        </div>
    </div>
                </div>
            </div>
    </div>
    </body>
</html>