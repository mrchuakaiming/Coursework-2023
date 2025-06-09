<?php
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <body style="background-image: url('image/bglogin.jpg');">
    <div class="w3-sidebar w3-bar-block w3-teal" style="width:30%;right:0; background-image:url('image/bgpengbaru.jpg');">
    <div style="height: 80px;">&nbsp;</div>
    <div class="w3-row">
    <div class="w3-col m3">&nbsp;</div>
    <div class="w3-col m6 w3-center">
        <img src="image/baru.png" class="w3-image" style="width: 75px;">
        <h4 class="w3-border w3-round-xxlarge w3-border-white">Hadapi masalah semasa sign up?</h4>
        <p>Sila hubungi staff kami 012-3456789 untuk mendapatkan bantuan.</p>
        <a href="login.php" class="w3-text-light-blue">Klik sini untuk kembali ke login.</a>
    </div>
    <div class="w3-col m3">&nbsp;</div>
    </div>
    </div>
    <br><br>
        <div class="w3-row">
            <div class="w3-col m2">
                &nbsp;
            </div>
            <div class="w3-col m5">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-col m8"> 
                        <div class="w3-container"> 
                        <h3 class="w3-margin"><b>Sign Up</b> <i class="fa fa-user-plus" aria-hidden="true"></i></h3>
                    </div>
                </div>

                    <div class="w3-container w3-white">
                          <form class="w3-container" method="POST" action="checksignup.php">
                            <label class="w3-text-gray"><b>ID Pengguna:</b></label>
                            <span class="w3-text-red">*4-digit nombor</span>
                            <i class="fa fa-id-card-o" aria-hidden="true"></i>
                            <input class="w3-input w3-border w3-light-grey" type="text" name="IDPengguna" pattern="[0-9]{4}" oninvalid="this.setCustomValidity('Sila masukkan 4 digit nombor sahaja.')" oninput="this.setCustomValidity('')" required placeholder="ID Pengguna">
                            <br>

                            <label class="w3-text-gray"><b>Nama:</b></label>
                            <span class="w3-text-red">*</span>
                            <i class="fa fa-user"></i>
                            <input class="w3-input w3-border w3-light-grey" type="text" name="nama" required placeholder="Nama">
                            <br>
                          
                            <label class="w3-text-gray"><b>Kata laluan: </b>
                            <span class="w3-text-red">* min 8, max 16 aksara</span>
                            <i class="fa fa-lock w3-text-black"></i></label>
                            <input class="w3-input w3-border w3-light-grey" type="password" name="kataLaluan" pattern="[0-9]{8,16}" oninvalid="this.setCustomValidity('Sila masukkan 8-16 aksara sahaja.')" oninput="this.setCustomValidity('')" required placeholder="Kata Laluan">
                          
                            <br>

                            <button class="w3-btn w3-green" type="submit" onclick="checkid();">Sign Up <i class="fa fa-key"></i></button>
                            <button class="w3-btn w3-red" type="reset">Reset <i class="fa fa-refresh"></i></button>
                            <!--Papar borang sign up pengguna baharu-->

                          </form>
                    </div>
                    <?php
                        @$err = $_GET["err"];
                        if ($err == 1){
                            echo "<script>alert('Sign up gagal. ID Pengguna yang dimasukkan sudah wujud. Sila cuba lagi dengan ID Pengguna baharu.')</script>";
                            echo "<div class='w3-panel w3-pale-red w3-leftbar w3-border-red'>
                            <p>ID Pengguna yang diisi telah diambil. Sign up gagal. Sila cuba lagi dengan ID Pengguna baru.</p>
                            </div>";
                        }else{
                            echo "<div class='w3-panel w3-pale-green w3-leftbar w3-border-green'>
                            <p>Sila sign up untuk menjadi pengguna laman sesawang ini jika anda tiada akaun peribadi pengguna.</p>
                        </div>";
                        }
                    ?>
                    </div>
            </div>
            <div class="w3-col m1">
                &nbsp;
            </div>
            <div class="w3-col m4">
                
                </div>
            </div>
        </div>
    </body>
</html>
