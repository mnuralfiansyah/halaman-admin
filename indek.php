<?php
SESSION_START();
include 'fungsi.php';

cek_session($_SESSION['name'],$_SESSION['email']);
echo $_SESSION['name'];
echo "<br>";
echo $_SESSION['email'];
echo "<br>";
echo $_SESSION['tanggal'];
echo "<br>";
echo $_SESSION['jam'];

?>
<br><a href="logout.php">LOGOUT</a>