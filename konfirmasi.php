 <?php
 SESSION_START();
include 'fungsi.php';
cek_session($_SESSION['name'],$_SESSION['email']);
if ($_SESSION['status']==0)
{
	header ('location:new.php');
}
 
 $konfirmasi=$_POST['konfirmasi'];
 $email=$_POST['email'];
 
	 $query="UPDATE admin SET status='$konfirmasi' WHERE email='$email'"; 
	 $query=mysqli_query($koneksi,$query);
	 
	 if($query)
	 {
		 header ('location:index.php?eror=Berhasil Konfirmasi');
	 }
	 else
	 {
		  header ('location:pesan.php?gagal');
	 }
 ?>
 