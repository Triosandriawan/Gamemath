<?php
//untuk menjalankan session
session_start();

//koneksi database 
$link = mysqli_connect('localhost', 'id13958587_daniel', 'Erick_11022000', 'id13958587_gamemath');
    
//menguji error koneksi database
if (!$link){
    die('ada error ' . mysqli_connect_error());
}

//Memproses form
if ( isset( $_POST['submit']))
{
    //membuat variabel baru dari post nama, email.
    $name = $_POST['nama'];
    $email = $_POST['email'];

    //query mencari user dan email
    $sql_nama = "SELECT nama, email FROM player WHERE nama='$name'";
    $result = mysqli_query($link, $sql_nama);

    //membuat array untuk menyimpan data nama, email dari database
    $nama_caridb = array();
    $email_caridb = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($data = mysqli_fetch_assoc($result)) {
            $data_nama = $data['nama'];
            $data_email = $data['email'];
            //input data ke array
            array_push($nama_caridb, $data_nama);
            array_push($email_caridb, $data_email);
        }
    }
    //mengubah data array menjadi string
    $nama_str = implode("", $nama_caridb);
    $email_str = implode("", $email_caridb);

    //Pengkondisian apabila player sudah terdaftar atau belum
    if($name == $nama_str && $email = $email_str){
        //session nama
        $_SESSION['nama_user'] = $_POST['nama'];
        //session nilai default jawab benar dan salah
        $_SESSION['live'] = 5;
        $_SESSION['skor'] = 0;
        //redirect ke old_player.php
        header('Location:old_player.php');
        die();
    } else{
        //query daftar input data baru user ke database
        $query_daftar = "INSERT INTO player (nama, email, skor) VALUES ('$name', '$email', 0)";
        $hasil_daftar = mysqli_query($link, $query_daftar);
        //session nama
        $_SESSION['nama_user'] = $_POST['nama'];
        //session nilai default jawab benar dan salah
        $_SESSION['live'] = 5;
        $_SESSION['skor'] = 0;
        //redirect ke gameplay.php
        header('Location:gameplay.php');
        die();
    }
}
//menutup koneksi
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamemath</title>
</head>
<body class="content">
    <!-- form Login Game -->
    <h1> Gamemath </h1>
<form action="index.php" method="post">
<table >
    <tr>
        <td>Masukkan Nama</td>
        <td>: <input type="text" name="nama"></td>
    </tr>
    <tr>
        <td>Masukkan Email</td>
        <td>: <input type="text" name="email"></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right"><input type="submit" name="submit"></td>
    </tr>
</table>
</form>
</body>
</html>
