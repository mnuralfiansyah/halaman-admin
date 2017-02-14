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
                                        <th>Email</th>
										<th>hari, Tanggal Login</th>
										<th>Jam</th>
										<th>hari, Tanggal Logout</th>
										<th>Jam</th>
										<th>Total Aktif</th>
										<!--<th>Status</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    
<?php 								
$query="SELECT * FROM catatanlogin order by id_login desc";
$query=mysqli_query($koneksi, $query);
while($hasil=mysqli_fetch_array($query))
{
	
	
?> 									
									<tr>
                                        <td><?php echo $hasil[1];?></td>
										<td><?php echo $hasil[2].", ".tanggal($hasil[3]);?></td>
										<td><?php echo $hasil[4];?></td>
										<td <?php  if (empty($hasil[5])) { echo " bgcolor='red' > Sedang Login";} else { echo '>'.$hasil[5].", ".tanggal($hasil[6]);} ?></td>
										<td <?php  if (empty($hasil[5])) { echo " bgcolor='red' >";} else { echo "> $hasil[7]";} ?></td>
										<td <?php  if (empty($hasil[5])) { echo " bgcolor='red' >";} else { echo ">".selisih_jam($hasil[4],$hasil[7]);} ?></td>
									</tr>
<?php
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
	