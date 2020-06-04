<?php
//Menjalankan Session
session_start();
//Output Pemain yang sudah terdaftar
echo "Hallo " . $_SESSION['nama_user'] . ", Selamat datang kembali dalam permainan ini!!!<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OldPlay</title>
</head>
<body>
    <!-- Form Memulai Game baru -->
    <form action='gameplay.php' method='post'>
        <input type='submit' name='gameplay' value='Start Game'>
    </form>
    <!-- Link untuk kembali ke halaman index -->
    <p>Bukan Anda? <a href="index.php">(klik di sini)</a></p>
</body>
</html>