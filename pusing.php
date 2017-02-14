function lupa_password($email)
	{
		global $koneksi;
		$email=mysqli_real_escape_string($koneksi, $email);
		$ada =cek_email_register($email);
		if($ada==false)
		{	
			$query="SELECT * FROM pesan WHERE dari='$email' AND status='1'";
			$query=mysqli_query($koneksi, $query);
			$hasil=mysqli_num_rows($query);
			if($hasil==0)
			{
				$_SESSION['email']=$email;
				$_SESSION['verifikasi']=date('h:m:s');
				$session=date('h:m:s');
				$query="INSERT INTO pesan VALUES ('','$email','Lupa Password','1','$session')";
				$query=mysqli_query($koneksi, $query);
				
				if($query)
				{
					header ('location:test.php');
				}
				else
				{
					header ('location:lupa.php?eror=salah kueri');
				}
			}
			else
			{
				header ('location:lupa.php?eror=sabar ya belum diliat admin');
			}
		}
		else
		{
			header ('location:lupa.php?eror=email tidak terdaftar');
		}
	}