<?php
 if (empty($koneksi))
	 header ('location:../404.html')
?>

    <section class="content">
        <div class="container-fluid">
             <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
                        <div class="header">
                            <ul class="header-dropdown m-r--5"></ul>
<?php if ($_SESSION['status']=='1')
{ ?>					<div>			
							<table width="100%">
								<tr>
									<td width="10%" align="left"><a href="aktifitasadmin.php"  ><button  type="button" class="btn bg-cyan waves-effect"><i class="material-icons">mail</i><br>Aktifitas </button></a></td>
									<td width="10%" align="left"><a href="catatanlogin.php"  ><button  type="button" class="btn bg-cyan waves-effect"><i class="material-icons">mail</i><br>Catatan Login</button></a></td>
									<td align="right"><a href="tambahadmin.php"  ><button  type="button" class="btn bg-cyan waves-effect"><i class="material-icons">add_person</i><br>Tambah Admin</button></a></td>
								</tr>
							</table>
						</div>	
<?php	} ?>	
			
							
                        </div>
						
	
						
						
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
										<th>Amanah</th>
										<th> </th>
										<!--<th>Status</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    
<?php 								
global $koneksi;
								  
$query ="SELECT * FROM admin";
$sql = mysqli_query ($koneksi, $query);
								  
$i=0;
								  
while ($data =  mysqli_fetch_array($sql))

{
	$i++;
	$idadmin=$data[0];
	$namaadmin=$data[1];
	$emailadmin=$data[2];
	$jabatanadmin=$data[3];
	
	
?> 									
									<tr>
                                        <th><?php echo "$i"; ?></th>
                                        <td><?php echo "$namaadmin"; ?></td>
                                        <td><?php echo "$emailadmin"; ?></td>
										<td><?php echo "$jabatanadmin"; ?></td>
										<td>
											<?php if ($_SESSION['email']==1)
											{ ?>
										
											<a href="deleteadmin.php?id=<?php echo "$idadmin"; ?>"><button type="button" class="btn btn-danger waves-effect">Hapus</button></a>
											<a href="aktifitasadmin.php?id=<?php echo "$idadmin"; ?>"><button type="button" class="btn btn-success waves-effect">Aktifitas</button></a>										
<?php
											}										
}
?>									
									
									
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>
	