    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">ADMINBSB - MATERIAL DESIGN</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
<!------------------------------- #END# Call Search ---------------------------------------------------------------------------------->
				
<!-------------------------------<Notifications>-------------------------------------------------------------------------------------->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">mail</i>
							<?php if (pesan_belum_dibaca()!=0) {?> <span class="label-count"><?php echo pesan_belum_dibaca(); ?></span> <?php } ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Pesan</li>
                            <li class="body">
<!------------------------------PERULANGAN DIMULAI DARI SINI -------------------------------------------------------------->
<?php
	$query="SELECT pesan.isi, admin.name, pesan.id_pesan, pesan.tanggal FROM pesan, admin WHERE  pesan.dari=admin.email AND pesan.status='1' order by id_pesan desc LIMIT 5";
	$query=mysqli_query($koneksi, $query);
	$count=mysqli_num_rows($query);
	
	while($hasil=mysqli_fetch_array($query))
	{
?>							
                                <ul class="menu">
                                    <li>
                                        <a href="index.php?page=pesan&id=<?php echo $hasil[2]; ?>">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">mail</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?php echo $hasil[1]; ?></h4>
                                                <p>
													<i class="material-icons">message</i> <?php echo $hasil[0]; ?>
												</p>
												<p>
                                                    <i class="material-icons">history</i> <?php echo waktu($hasil[3]); ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
<?php								
	}
?>	
<!------------------------------<PERULANGAN DIAKHIR DI SINI>-------------------------------------------------------------->								
                            </li>
                            <li class="footer">
<?php if (pesan()==0) { echo '<a href="#"> Tidak Ada Pesan</a>'; } else {?>
                                <a href="index.php?page=pesan">Tampilkan Semua Pesan <?php echo '('.pesan().')'; } ?> </a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>