<?php
SESSION_START();
include 'fungsi.php';
cek_session($_SESSION['name'],$_SESSION['email']);
if ($_SESSION['status']==0)
{
	header ('location:new.php');
}
?>
<!DOCTYPE html>
<html>
<!--INI TEMPATNYA HEAD--------------------------------------------------------------------------------------------------------->
<?php include 'head.php';?>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
		<form action="index.php" method="GET">
		<input type="hidden" name="page" value="cari">
        <input type="text" name="cari" placeholder="START TYPING...">
		</form>
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
<!-- INI TEMPATNYA NAV --------------------------------------------------------------------------------------------------------------->
<?php include 'nav.php';?>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
<!---User Info----------------------------------------------------------------------------------------------------------------------------------->
<?php include 'userinfo.php';?>
            <!-- #User Info -->
<!-------MENU LETAKNYA DISINI--------------------------------------------------------------------------------------------------------->            
 <?php include 'menu.php';?>           
			<!-- #Menu -->
<!---Footer--------------------------------------------------------------------------------------------------------------------------->
<?php include 'footer.php';?>
            
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
<!-- rightsidebar--------------------------------------------------------------------------------------------------------------------->
<?php include 'rightsidebar.php';?>        
        <!-- #END# Right Sidebar -->
    </section>
<!---INI TEMPATNYA BODY--------------------------------------------------------------------------------------------------------------->	
<?php include 'body.php';?> 




<!---INI TEMPATNYA PLUGIN---------------------------------------------------------------------------------------------------------------------------->
<?php include 'plugin.php';?> 
</body>

</html>