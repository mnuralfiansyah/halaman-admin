 <?php
 require_once 'koneksi.php';

 //untuk tanggal format dalam bahasa indonesia
	function tanggal($date)
	{
		$namabulan = array ("Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$tahun = substr($date,0,4);
		$bulan = substr($date,5,2);
		$tanggal = substr($date,8,2);
		
		$result= $tanggal." ".$namabulan[(int)$bulan-1]." ".$tahun;
		return ($result);
	}


//untuk penamaan hari dalam bahasa indonesia	
	function hari ()
	{
		$hari= date('l');
		if ($hari=='Monday')
		{
			$hari = "Senin";
		}
		else if ($hari=='Tuesday')
		{
			$hari = "Selasa";
		}
		else if ($hari=='Wednesday')
		{
			$hari = "Rabu";
		}
		else if ($hari=='Thursday')
		{
			$hari = "Kamis";
		}
		else if ($hari=='friday')
		{
			$hari = "Jum'at";
		}
		else if ($hari=='Saturday')
		{
			$hari = "Sabtu";
		}
		else
		{
			$hari = "Minggu";
		}
		
		return $hari;
	}

//untuk catat login 
	function catat_login($tanggal,$email)
	{
		global $koneksi;
		$hari=hari();
		$jam= date('h:i:s');
		
		$email=mysqli_real_escape_string($koneksi, $email);
		
		$query="INSERT INTO catatanlogin VALUES ('','$email','$hari','$tanggal','$jam','','','')";
		$query= mysqli_query($koneksi,$query);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

//untuk catat logout	
	function catat_logout($tanggal,$email,$jams,$tanggals)
	{
		global $koneksi;
		$hari=hari();
		$jam= date('h:i:s');
		
		$email=mysqli_real_escape_string($koneksi, $email);
		
		$query="UPDATE catatanlogin SET harikeluar='$hari', tglkeluar='$tanggal', jamkeluar='$jam' 
		WHERE
		email='$email' and jammasuk='$jams' and tglmasuk='$tanggals'";
		$query= mysqli_query($koneksi,$query);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
 
//untuk cek apakah email sudah di daftar 
	function cek_email_register($email)
	{
		global $koneksi;
		$email= mysqli_real_escape_string ($koneksi, $email);
		$query="SELECT * FROM admin where email='$email'";
		$query = mysqli_query($koneksi, $query);
		
		if (mysqli_num_rows($query)==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
 
 
 //untuk registrasi
	function register($name, $email, $password, $repassword)
	{
		global $koneksi;
		$name= mysqli_real_escape_string ($koneksi, $name);
		$email= mysqli_real_escape_string ($koneksi, $email);
		$password= mysqli_real_escape_string ($koneksi, $password);
		$repassword=mysqli_real_escape_string($koneksi, $repassword);
		
		if($password==$repassword)
		{	
			if(cek_email_register($email))
			{
				$status=0;
				$query="INSERT INTO admin VALUES ('','$name','$email','$password','$status')";
				$query=mysqli_query($koneksi,$query);
				if ($query)
				{
					SESSION_START();
					$_SESSION['name']=$name;
					$_SESSION['email']=$email;
					$_SESSION['status']=$status;
					$waktu=date('H:i:s');

					$query="INSERT INTO pesan VALUES ('','$email','konfirmasi','1','$waktu')";
					$query=mysqli_query($koneksi,$query);
					if ($query)	
					{
						header ('location: index.php');
					}
					else
					{
						header ('location: index.php?eror=Salah Kueri');
					}	
					
				}
				else
				{
					header ('location: registrasi.php?eror=gagal registrasi');
				}
			}
			else
			{
				header ('location: registrasi.php?eror=nama sudah ada');
			}
		}
		else
		{
			header ('location: registrasi.php?eror=password tidak sama');
		}
	}


//untuk cek session apakah sudah ada atau belum	
	function cek_session($name, $email)
	{
	  global $koneksi;
		
		if((empty($name)) and (empty($email)))
		{
			header ('location:login.php');
		} 
		else if ((!empty($name)) and (!empty($email)))
		{
			$name=mysqli_real_escape_string($koneksi, $name);
			$email=mysqli_real_escape_string($koneksi, $email);
			
			$query="SELECT * FROM admin WHERE email='$email' AND email='$email'";
			$query=mysqli_query($koneksi, $query);
			
			if(($hasil= mysqli_num_rows($query))==0)
			{
				header ('location:login.php?page=login');
			}
		}
		else
		{
			header ('location:login.php?page=login');
		}
	}
	

//untuk login
	function login($email,$password)
	{
		global $koneksi;
		$query="SELECT * FROM admin WHERE email='$email' AND password='$password'";
		$query=mysqli_query($koneksi, $query);
		$hasil=mysqli_fetch_array($query);
		
		if ($hasil)
		{
			SESSION_START();
			$_SESSION['name']=$hasil[1];
			$_SESSION['email']=$hasil[2];
			$_SESSION['status']=$hasil[4];
			$_SESSION['tanggal']=date('Y-m-d');
			$_SESSION['jam']=date('h:i:s');
			
			$date = date('Y-m-d');
			$catat= catat_login($date,$_SESSION['email']);
			
			if ($catat)
			{
					header ('location: index.php');
			}
			else
			{
				header ('location:login.php?eror=catat login gagal');
			} //*/
		}
		else
		{
			header ('location:login.php?eror=data salah');
		}
			
	}

//untuk menghitung selisih jam

	function selisih_jam($login, $logout)
	{
		list($h,$m,$s)=explode(":",$login);
		$dtawal=mktime($h,$m,$s,"1","1","1");
		list($h,$m,$s)=explode(":",$logout);
		$dtakhir=mktime($h,$m,$s,"1","1","1");
		$dtselisih=$dtakhir-$dtawal;
		
		
		$totalmenit=$dtselisih/60;
		$jam = explode(".",$totalmenit/60);
		$sisamenit=($totalmenit/60)-$jam[0];
		$sisamenit=$sisamenit*60;
		
		return "$jam[0] jam ".ceil($sisamenit)." menit";
		
	}

	function judul()
	{
		global $koneksi;
		
		$query="SELECT * FROM tabel_admin";
		$query=mysqli_query($koneksi, $query);
		$result=mysqli_fetch_array($query);
		return $result[1];
	}
	
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
				//////////////////////////////////////////////////////////////////////////
				/////////////////PERBAIKI DISINI//////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////
				$query="SELECT * FROM verifikasi WHERE email='$email' AND stts='1' AND reset='1'";
				$query=mysqli_query($koneksi, $query);
				$hasil=mysqli_num_rows($query);
				if($hasil==0)
				{				
					$_SESSION['email']=$email;
					$_SESSION['verifikasi']=date('h:m:s');
					$session=date('h:m:s');
					$waktu=date('Y-m-d');


					$query="INSERT INTO pesan VALUES ('','$email','Lupa Password','1','$session','$waktu')";
					$query=mysqli_query($koneksi, $query);
					
					if($query)
					{
						header ('location:verifikasi.php'); ///////
					}
					else
					{
						header ('location:lupa.php?eror=salah kueri');
					}
				}
				else
				{
					
					$_SESSION['email']=$email;
					header ('location:verifikasi.php');///
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
	
		function selisih_menit($login, $logout)
	{
		list($h,$m,$s)=explode(":",$login);
		$dtawal=mktime($h,$m,$s,"1","1","1");
		list($h,$m,$s)=explode(":",$logout);
		$dtakhir=mktime($h,$m,$s,"1","1","1");
		$dtselisih=$dtakhir-$dtawal;
		
		
		$totalmenit=$dtselisih/60;
		$jam = explode(".",$totalmenit/60);
		$sisamenit=($totalmenit/60)-$jam[0];
		$sisamenit=$sisamenit*60;
		
		return $menit=ceil($sisamenit);	
	}
	
	function reset_login($email)
	{
		global $koneksi;
		$query="SELECT * FROM admin WHERE email='$email'";
		$query=mysqli_query($koneksi, $query);
		$hasil=mysqli_fetch_array($query);
		
		if ($hasil)
		{
			SESSION_START();
			$_SESSION['name']=$hasil[1];
			$_SESSION['email']=$hasil[2];
			$_SESSION['status']=$hasil[4];
			$_SESSION['tanggal']=date('Y-m-d');
			$_SESSION['jam']=date('h:i:s');
			
			$date = date('Y-m-d');
			$catat= catat_login($date,$_SESSION['email']);
			
			if ($catat)
			{
					header ('location: index.php');
			}
			else
			{
				header ('location:login.php?eror=catat login gagal');
			} //*/
		}
		else
		{
			header ('location:login.php?eror=data salah');
		}
			
	}
	
	function pesan_belum_dibaca()
	{
		global $koneksi;
				
		$query="SELECT * FROM pesan where status='1'";
		$query=mysqli_query($koneksi, $query);
		$query=mysqli_num_rows($query);
		return $query;
		
	}
	
	function pesan()
	{
		global $koneksi;
				
		$query="SELECT * FROM pesan";
		$query=mysqli_query($koneksi, $query);
		$query=mysqli_num_rows($query);
		return $query;
		
	}
	
	function kode_acak()
	{
		$acak='';
		for($i=1;$i<=4;$i++)
		{
			$nomor=rand(0, 9);
			$acak.=$nomor;
		}
		return $acak;
	}
	
	function checkDifference($time)
	{
		if ($time->y > 0) { return $time->y . ' tahun';}
		if ($time->m > 0) { return $time->m . ' bulan';}
		if ($time->d > 0) { return $time->d . ' hari';}
		if ($time->h > 0) { return $time->h . ' jam';}
		if ($time->i > 0) { return $time->i . ' menit';}
		if ($time->s > 6) { return $time->s . ' detik';}
		if (($time->s >0) and ($time->s < 6 )) { return $time->s . 'beberapa detik';}
	}
	
		function waktu ($content)
	{
		$now = new DateTime();
		$content = new DateTime($content);
			
		$interval=$content->diff($now);
			
		echo checkDifference($interval) . ' yang lalu'; 
	}
?>	