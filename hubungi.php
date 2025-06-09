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
            <a href="banding.php" class="w3-bar-item w3-button w3-mobile">Perbandingan <i class="fa fa-arrows-h" aria-hidden="true"></i></a>
            <a href="carian.php" class="w3-bar-item w3-button w3-mobile">Carian <i class="fa fa-search" aria-hidden="true"></i></a>
            <a href="hubungi.php" class="w3-bar-item w3-button w3-mobile w3-green">Hubungi Kami <i class="fa fa-phone"></i></a>
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
        <div class="w3-twothird w3-container">
        <h4 class="w3-bottombar w3-border-teal">Hubungi Kami <i class="fa fa-phone" aria-hidden="true"></i></h4>
        </div>
          </div>
          <br><br><br>
          <h1 class="w3-margin-left"><b>Hubungi kami untuk makluman lanjut:</b></h1>
                <div class="w3-row">
                    <div class="w3-col m3 w3-margin-left w3-margin-right w3-border w3-round-xlarge">
                        <br>
                        <h4 class="w3-margin-left"><b>Dalam talian:</b></h4><br>
                        <h4 class="w3-margin-left"><i class="fa fa-whatsapp" aria-hidden="true"></i>  019-8765432</h4>
                        <h4 class="w3-margin-left"><i class="fa fa-whatsapp" aria-hidden="true"></i>  019-87654321</h4>
                        <br>
                        <h5 class="w3-text-gray w3-margin-left">Isnin hingga Jummat:</h5>
                        <h5 class="w3-text-gray w3-margin-left">10 a.m. - 10 p.m.</h5><br>
                        <h5 class="w3-text-gray w3-margin-left">Sabtu dan Ahad:</h5>
                        <h5 class="w3-text-gray w3-margin-left">10 a.m. - 6 p.m.</h5><br>
                    </div>
                    <div class="w3-col m3 w3-margin-left w3-margin-right w3-border w3-round-xlarge">
                        <br>
                        <h4 class="w3-margin-left"><b>Panggilan Telefon:</b></h4><br>
                        <h4 class="w3-margin-left"><i class="fa fa-phone" aria-hidden="true"></i>  019-8765432</h4>
                        <h4 class="w3-margin-left"><i class="fa fa-phone" aria-hidden="true"></i>  019-87654321</h4>
                        <br>
                        <h5 class="w3-text-gray w3-margin-left">Isnin hingga Jummat:</h5>
                        <h5 class="w3-text-gray w3-margin-left">10 a.m. - 10 p.m.</h5><br>
                        <h5 class="w3-text-gray w3-margin-left">Sabtu dan Ahad:</h5>
                        <h5 class="w3-text-gray w3-margin-left">10 a.m. - 6 p.m.</h5><br>
                    </div>
                    <div class="w3-col m3 w3-margin-left w3-margin-right w3-border w3-round-xlarge">
                        <br>
                        <h4 class="w3-margin-left"><b>Ikuti akaun media sosial kami:</b></h4><br>
                        <h4 class="w3-margin-left w3-text-grey"><i class="fa fa-facebook" aria-hidden="true"></i>  SmartTech</h4>
                        <h4 class="w3-margin-left w3-text-grey"><i class="fa fa-instagram" aria-hidden="true"></i>  smarttech2023</h4>
                        <br>
                        <h4 class="w3-margin-left"><b>E-mel untuk bertanya maklumat lanjut:</b></h4><br>
                        <h4 class="w3-margin-left w3-text-grey"><i class="fa fa-envelope-o" aria-hidden="true"></i>  smarttech2023@gmail.com</h4>
                        <br><br><br>
                    </div>
            </div>
        </body>
</html>