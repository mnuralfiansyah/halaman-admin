<?php
session_start();
include 'fungsi.php';

$catat= catat_logout(date('Y-m-d'),$_SESSION['email'],$_SESSION['jam'],$_SESSION['tanggal']);
if ($catat)
{
 session_destroy();
 header ('location: login.php');
}
else
{
	header ('location: index.php?gagal logout');
}
 ?>