<?php
 SESSION_START();
include 'fungsi.php';
cek_session($_SESSION['name'],$_SESSION['email']);


if(($_POST['answer']!=1) or ($_SESSION['status']==0))
{
	header ('location:index.php?eror=?');
}
else
{
	$email= $_POST['email'];

	$acak=kode_acak();

	$query="INSERT INTO verifikasi VALUES ('','$email','$acak','1','1')";
	$query=mysqli_query($koneksi, $query);
	if($query)
	{
		header ('location: index.php');
	}
	else
	{
		header ('location: index.php?eror gagal ke verfikasi');
	}
}


?>