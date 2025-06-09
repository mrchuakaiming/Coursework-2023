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
                var ans = confirm("Adakah anda pasti untuk delete item ini?");
                return ans;
                /*Mesej pengesahan untuk delete*/
            }
        </script>
    </head>
    <body id="title">
        <div class="w3-bar w3-blue">
            <a href="tambah.php" class="w3-bar-item w3-button w3-mobile">Tambah Item <i class="fa fa-plus" aria-hidden="true"></i></a>
            <a href="edit.php" class="w3-bar-item w3-button w3-mobile w3-green">Edit Item <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
        <div class="w3-row">
        <?php
                @$delete = $_GET["delete"];
                if ($delete == 1){
                    echo"<script>alert('DELETE item berjaya!')</script>";
                }
                @$edit = $_GET["edit"];
                if ($edit == 1){
                    echo"<script>alert('EDIT item berjaya!')</script>";
                }
        ?>
            <div class="w3-col m8 w3-margin-left w3-margin-right">
                <div class="w3-twothird w3-container">
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'smarttech');
                $query = "SELECT * FROM item";
                $result = mysqli_query($conn, $query);
                $count = 0;
                while($row=mysqli_fetch_array($result)){
                    $kodI = $row["kodItem"];
                    $count++;
                }
                echo"<h4 class='w3-bottombar w3-border-teal'>Senarai Item <i class='fa fa-mobile' aria-hidden='true'></i> 
                <span style='float: right; font-size: 20px;' class='w3-margin-right'> Jumlah item = <b>$count</b> <i class='fa fa-book' aria-hidden='true'></i></span></h4>";
                ?>
                </div>
                <table class="w3-border w3-table w3-striped">
                    <thread>
                        <tr class="w3-teal">
                            <th>Kod Item</th>
                            <th>Nama Item</th>
                            <th>Keterangan</th>
                            <th>Imej</th>
                            <th>Nama Staf</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thread>
                    <?php
                    $query = "SELECT * FROM item
                            join jenama on item.kodJenama=jenama.kodJenama
                            join ram on item.kodRAM=ram.kodRAM
                            join storaningatan on item.kodStoranIngatan=storaningatan.kodStoranIngatan
                            join staf on item.IDStaf=staf.IDStaf
                            ORDER BY item.kodItem";
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
                        $nStaf = $row["namaStaf"];
                        $stat = $row["stat"];

                        if($stat == "A"){
                            $class = "black";
                        } else{
                            $class = "red";
                        }

                        echo "<tr><td>$kItem</td>
                            <td>$nItem</td>
                            <td><b>Jenama:</b> $jenama<br><b>Harga:</b> RM$harga<br><b>Kapasiti Bateri:</b><br> $bateri mAh<br><b>Storan Ingatan:</b><br> $sIngatan GB<br><b>RAM:</b> $ram GB<br></td>
                            <td><img src='image/$image' height='170px'></td>
                            <td class='w3-text-$class'>$nStaf</td>
                            <td class='w3-text-$class'>$stat</td>
                            <td><a href='edititem.php?kodItem=$kItem'>Edit <i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                            <a href='#'>
                            <form method='GET' action='deleteitem.php' style='margin: 0 0 0 0;' onsubmit='return errmsg();'>
                            <input type='hidden' name='kodItem' value='$kItem'>
                            <input type='submit' class='w3-text-red' value='Delete'><i class='fa fa-trash-o w3-text-red' aria-hidden='true'></i></form></a></td></tr>";
                }
                    #Papar senarai item untuk edit atau delete
                    ?>   
                </table>
            </div>
            <div class="w3-col m4 w3-margin-left">
            
            </div>
                </div>
            </div>
        </div>
    </body>
</html>