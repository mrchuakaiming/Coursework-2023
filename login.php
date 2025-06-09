<?php
    session_start();
    #Memulakan sesi
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
        <h4 class="w3-border w3-round-xxlarge w3-border-white">Pengguna baru?</h4>
        <a href="signup.php" class="w3-text-light-blue">Klik sini untuk melakukan sign up.</a>
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
                        <h3 class="w3-margin"><b>Login</b> <i class="fa fa-sign-in" aria-hidden="true"></i></h3>
                    </div>
                </div>

                    <div class="w3-container w3-white">
                          <form class="w3-container" method="POST" action="check.php">
                            <label class="w3-text-gray"><b>ID Pengguna:</b></label>
                            <span class="w3-text-red">*</span>
                            <i class="fa fa-user"></i>
                            <input class="w3-input w3-border w3-light-grey" type="text" name="IDPengguna" required placeholder="ID Pengguna">
                            <br>
                          
                            <label class="w3-text-gray"><b>Kata laluan: </b>
                            <span class="w3-text-red">*</span>
                            <i class="fa fa-lock w3-text-black"></i></label>
                            <input class="w3-input w3-border w3-light-grey" type="password" name="kataLaluan" required placeholder="Kata Laluan">
                          
                            <br>

                            <button class="w3-btn w3-green" type="submit">Login <i class="fa fa-key"></i></button>
                            <button class="w3-btn w3-red" type="reset">Reset <i class="fa fa-refresh"></i></button>
                            <!--Mendapatkan ID Pengguna dan kata laluan pengguna untuk daftar masuk-->
                          </form>
                    </div>
                    <?php
                        @$err = $_GET["err"];
                        #Jika terdapat ralat semasa login akan disemak oleh check.php
                        if ($err == 1){
                            echo "<script>alert('Login gagal. Sila cuba lagi.')</script><div class='w3-panel w3-pale-red w3-leftbar w3-border-red'>
                            <p>Login gagal. Sila cuba lagi.</p>
                            </div>";
                        } else if ($err == 2){
                            echo "<script>alert('Amaran! Sila login sebelum memasuki laman sesawang.')</script><div class='w3-panel w3-pale-yellow w3-leftbar w3-border-yellow'>
                            <p>Amaran! Sila login sebelum memasuki laman sesawang.</p>
                            </div>";
                        } else if ($err == 3){
                            echo "<script>alert('Akaun anda telah DIPADAM. Sila HUBUNGI staf kami 012-3456789 untuk mengaktifkan akaun anda ATAU sign up akaun baharu.')</script>";
                        } else{
                            echo "<div class='w3-panel w3-pale-green w3-leftbar w3-border-green'>
                            <p>Sila login untuk memasuki laman sesawang.</p>
                            </div>";
                        }
                        @$signin = $_GET["signin"];
                        if ($signin == 1){
                            echo "<script>alert('Sign up BERJAYA. Sila login untuk mengaskes laman web.')</script>";
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
