 <?php 
if(!empty($_GET['id']))
{	
	$id=mysqli_real_escape_string($koneksi, $_GET['id']);
	$query="UPDATE pesan SET status='0' WHERE id_pesan='$id'";
	$query=mysqli_query($koneksi, $query);

	$sql="SELECT * FROM pesan WHERE id_pesan='$id'";
	$sql=mysqli_query($koneksi, $sql);
	$result=mysqli_fetch_array($sql);	
	?>
 
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2> Dari : <?php echo $result[1];?></h2>
            </div>
			<div class="block-header">
				 <p>Isi : <?php echo $result[2];?> </p>
			</div>
			<div class="block-header">
				 <p>Jam : <?php echo $result[4];?> </p>
			</div>
        </div>
		<br><br><br><br>
		
<?php

	if($result[2]=='konfirmasi')
	{
			$email=mysqli_real_escape_string($koneksi, $result[1]);
			$query="SELECT status FROM admin WHERE email='$email'";
			$query=mysqli_query($koneksi, $query);
			$hasil=mysqli_fetch_array($query);
			
			if($hasil[0]==0)
			{
?>		
		<table width="30%" align="leftt">
			<tr>
				<td align="right">
					Apakah Anda Ingin Konfirmasi
				</td>
				<td align="right">
					<form action="konfirmasi.php" method="POST">
						<input name="konfirmasi" type="hidden" value="1">
						<input name="email" type="hidden" value="<?php echo $result[1]; ?>">
						<input type="submit" value="Ya">
					</form>
				</td>
				<td align="left">
					<form action="index.php" method="POST">
						<input type="submit" value="Tidak"></b>
					</form>
				</td>
			</tr>
		</table>	
<?php
			}
	}
	else if ($result[2]=='Lupa Password')
	{
?>
		<table width="70%" align="leftt">
			<tr>
				<td align="right">
					Apakah Anda Ingin Mengirim Kode Kepada <?php echo $result[1]; ?>
				</td>
				<td align="right">
					<form action="kode.php" method="POST">
						<input name="answer" type="hidden" value="1">
						<input name="email" type="hidden" value="<?php echo $result[1]; ?>">
						<input type="submit" value="Ya">
					</form>
				</td>
				<td align="left">
					<form action="index.php" method="POST">
						<input type="submit" value="Tidak"></b>
					</form>
				</td>
			</tr>
		</table>	

<?php		
	}
?>	
		
    </section>
<?php
}
else
{
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    EDITABLE TABLE
                    <small>Taken from <a href="https://github.com/mindmup/editable-table" taget="_blank">github.com/mindmup/editable-table</a></small>
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EXAMPLE
                                <small>You can edit any columns except header/footer</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table id="mainTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Dari</th>
                                        <th>Isi</th>
                                        <th>waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
<!-----------------------------------------------<DISINI PERULANGAN>----------------------------------------------------------------->
<?php
	$query="SELECT * FROM pesan order by id_pesan desc";
	$query=mysqli_query($koneksi, $query);

	while($hasil=mysqli_fetch_array($query))
	{
?>								
                                    <tr>
											<td><a href="index.php?page=pesan&id=<?php echo $hasil[0];?>"><?php if ($hasil['3']==1){ echo "(New) <b>".$hasil[1]."</b>";} else { echo $hasil[1]; }?></a></td>
											<td><?php echo $hasil[2];?></td>
											<td><?php echo waktu($hasil[4]);?></td>
                                    </tr>
<?php
	}
?>									
<!--------------------------------------------<DISINI AKHIR PERULANGAN>-------------------------------------------------------------->									
								</tbody>	
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/pages/tables/editable-table.js"></script>
<?php	
}	
?>	
	