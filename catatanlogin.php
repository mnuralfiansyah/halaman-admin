 <?php
 session_start();
 include 'fungsi.php';
 
cek_session($_SESSION['name'],$_SESSION['email']); 	
 ?>
 <table width="70%" align="center">
 <tr>
	<th>Email</th>
	<th>hari, Tanggal Login</th>
	<th>Jam</th>
	<th>hari, Tanggal Logout</th>
	<th>Jam</th>
 </tr>
 <?php
$query="SELECT * FROM catatanlogin";
$query=mysqli_query($koneksi, $query);
 while($hasil=mysqli_fetch_array($query))
{
 ?>
	<tr>
		<td align='left'><?php echo $hasil[1];?></td>
		<td align='center'><?php echo $hasil[2].", ".tanggal($hasil[3]);?></td>
		<td align='center'><?php echo $hasil[4];?></td>
		<td align='center' <?php  if (empty($hasil[5])) 
									{ echo "colspan='3' bgcolor='red'";}
								echo '>';  
								  if (!empty($hasil[5])) 
								  { echo $hasil[5].", ".tanggal($hasil[6]);?></td>
		<td align='center'><?php echo $hasil[7]; } else {  echo 'sedang aktif';} ?></td>
	</tr>
<?php
}
?>	
 </table>
 
 <a href="index.php">Back</a>