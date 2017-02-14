 
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
                                        <th align="center">Email</th>
										<th align="center">hari, Tanggal Login</th>
										<th align="center">Jam</th>
										<th align="center">hari, Tanggal Logout</th>
										<th align="center">Jam</th>
										<th align="center">Total Aktif</th>
										<!--<th>Status</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    
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
						<?php if (!empty($hasil[5])){?>
									<td align="center"><?php echo selisih_jam($hasil[4],$hasil[7]); ?></td>
											 <?php }?>
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
	 