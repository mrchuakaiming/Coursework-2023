<html>
    <head></head>
    <body>
    <form method="POST" action="test2.php" class="w3-form" enctype="multipart/form-data">
        <label>Import file:</label>
        <input type="file" name="importfile" class="w3-input w3-border" required>
        <br>
        <button type="submit" value="hantar" class="w3-btn w3-blue" onclick="alert('Adakah anda pasti untuk menambah item ini?');">Hantar</button>
        <a href="test.php" class="w3-btn w3-red">Reset</a>
    </form>
    <?php
    @$err = $_GET["err"];
    @$id = $_GET["id"];
    @$berjaya = $_GET["berjaya"];
    if($err == 1){
        echo "<script>alert('Fail yang dimasukkan bukan fail .txt import data gagal')</script>";
    }if($err == 2){
        echo "<script>alert('ID Pengguna [$id] telah wujud. Import data gagal.')</script>";
    }if($err == 3){
        echo "<script>alert('ID Pengguna [$id] mesti 4 nombor sahaja. Import data gagal.')</script>";
    }if($err == 4){
        @$kl = $_GET["kl"];
        echo "<script>alert('Kata laluan [$kl] mesti dalam julat 8-16 aksara sahaja. Import data gagal.')</script>";
    }if($err == 5){
        echo "<script>alert('Taraf pengguna yang dimasukkan tidak sah. Import data gagal.')</script>";
    }if($berjaya == 1){
        echo "<script>alert('Import data berjaya.')</script>";
    }
    ?>
    <body>
</html>