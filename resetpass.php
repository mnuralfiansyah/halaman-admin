 <?php
 SESSION_START();
 require_once 'fungsi.php';
if ((empty($_SESSION['kode'])) or (empty($_SESSION['kode']))) 
{
	header ('location:login.php');
}
else
{	
	 $kode=$_SESSION['kode'];
	 $email=$_SESSION['email'];
 
 	 $query="SELECT * FROM verifikasi WHERE email='$email' and reset='1' and kode='$kode'";
	 $query=mysqli_query($koneksi, $query);
	 $query=mysqli_num_rows($query);
	 if ($query==1)
	 {
 
		if((!empty($_POST['password'])) and (!empty($_POST['repassword'])))
		{
			if($_POST['password']==$_POST['repassword'])
			{
				$password=$_POST['password'];
				$password=mysqli_real_escape_string($koneksi, $password);
				$query="UPDATE admin SET password='$password' WHERE email='$email'";
				$query=mysqli_query($koneksi, $query);
				if($query)
				{
					$query="DELETE FROM verifikasi WHERE email='$email' AND kode='$kode'";
					$query=mysqli_query($koneksi, $query);
					if ($query)
					{
						reset_login($email);
					}
					else
					{
						header ('location:verifikasi.php?eror=query salah line 36');
					}
				}
				else
				{
					header ('location:verifikasi.php?eror=query salah line 41');
				}
			}
			else
			{
				header ('location:verifikasi.php?eror=Passwordnya tidak sama');
			}
			
		}
		else
		{	

?>
 <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login | <?php echo judul(); ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small><?php echo judul(); ?></small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="resetpass.php">
                    <div class="msg">silahkan Masukkan Password Anda</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="repassword" placeholder="Ulangi Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>



<?php
		 }
	}
	else
	{
		header ('location:verifikasi.php?eror=salah kode verifikasi');
	}
}
 ?>