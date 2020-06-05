<?php
//menjalankan session
session_start();

//koneksi database 
$link = mysqli_connect('localhost', 'id13958587_daniel', 'Erick_11022000', 'id13958587_gamemath');
    
//menguji error koneksi database
if (!$link){
    die('ada error ' . mysqli_connect_error());
}

//variabel session nama, skor
$name = $_SESSION['nama_user'];
$skor = $_SESSION['skor'];

//query input hasil permainan untuk mensave di database
$query = "UPDATE player SET skor=$skor WHERE nama='$name'";
$hasil = mysqli_query($link, $query);

//Output Akhir Game
echo "Hello ". $name.", Permainan sudah selesai. Terus coba dan jadi lebih baik.<br>Skor Anda : ". $skor . "<br>";
//HOF
echo "<h1> Hall of Fame </h1>";
//query untuk menampilkan tabel secara descending dengan limit 10
$sql = 'SELECT id, nama, skor FROM player ORDER BY skor DESC LIMIT 10';
$query = mysqli_query($link, $sql);
if (!$query) {
	die ('SQL Error: ' . mysqli_error($link));
}
echo "<table border='1' cellpadding=5 cellspacing=0>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Skor</th>
			</tr>
		</thead>
		<tbody>";
$i = 1;		
while ($row = mysqli_fetch_array($query))
{
	echo '<tr>
			<td>'.$i++.'</td>
			<td>'.$row['nama'].'</td>
			<td>'.$row['skor'].'</td>
		</tr>';
}
echo '
	</tbody>
</table>';

//menutup koneksi
mysqli_close($link);
//Menghapus semua session yang ada
session_destroy();
?>
<p>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>GameOver</title>
</head>
<body class="content">
	<!-- Form untuk Main Lagi -->
	<form action='index.php' method='post'>
		<input type='submit' name='mainlagi' value='Main Lagi'>
	</form>
</p>
</body>
</html>
