<?php
//menjalankan session
session_start();
//output info player
echo "Hello " . $_SESSION['nama_user'] . " tetap semangat ya... you can do the best!!<br>";
echo "Lives: <". $_SESSION['live'] . "> | Score: <" . $_SESSION['skor'] . ">";
//variabel x,y random angka 0 - 20
$x = rand(0,20);
$y = rand(0,20);
//kondisi pemrosesan form jawaban
if(isset($_POST['submit']))
{
    //membuat variabel dari pengambilan post form
    $jawab = $_POST['jawaban'];
    $hasil = $_SESSION['hasil'];
    $bil_1 = $_SESSION['bil1'];
    $bil_2 = $_SESSION['bil2'];
    if( $jawab == $hasil){
        //session bila jawaban benar skor di tambah 10
        $_SESSION['skor'] += 10;
        echo "<p>";
        echo "Hello " . $_SESSION['nama_user'] . " Selamat jawaban Anda benar...<br> $bil_1 + $bil_2 = $hasil <br>";
        echo "Lives: <". $_SESSION['live'] . "> | Score: <" . $_SESSION['skor'] . ">";
        echo "</p>";
        echo "<p>";
        //link untuk melanjutkan soal
        echo "<a href='gameplay.php'> [Soal selanjutnya]</a>";
        echo "</p>";
        die();
    } else{
        //session bila jawaban salah skor -2, live -1
        $_SESSION['skor'] -= 2;
        $_SESSION['live'] -= 1;
        echo "<p>";
        echo "Hello " . $_SESSION['nama_user'] . "  ,jawaban Anda salah <br> $bil_1 + $bil_2 = $hasil <br>";
        echo "Lives: <". $_SESSION['live'] . "> | Score: <" . $_SESSION['skor'] . ">";
        echo "</p>";
        echo "<p>";
        echo "<a href='gameplay.php'> [Soal selanjutnya]</a>";
        echo "</p>";
        if($_SESSION['live'] <= 0){
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gameover.php">';
            //header('Location:gameover.php');
            exit();
        }
    }
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamePlay</title>
</head>
<body class="content">
    <!-- FORM input jawaban -->
    <form action="gameplay.php" method="post">
    <!-- Output Soal -->
    <p> Berapakah 
    <?php 
    //membuat variabel soal dari x,y sebelumnya menjadi session sehingga data tersimpan dan bisa di proses
    $_SESSION['bil1'] = $x;
    $_SESSION['bil2'] = $y; 
    $_SESSION['hasil'] = $x + $y;
    echo "$x + $y "
    ?> = <input type="text" name="jawaban">
    <input type="submit" name="submit">
    </p>
    </form>
</body>
</html>
