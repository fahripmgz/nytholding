<?php 
session_start();
	if(isset($_POST)) {
include_once '../model/config.php';


		$message = array();
		if ( trim($_POST['txtUser'])=="") {
			$message[] = " <b>Please re-enter your User ID</b><br>The user ID you entered is incorrect. Please try again (make sure your caps lock is off).";		
		}
		if (trim($_POST['txtPassword'])=="") {
			$message[] = "<b>Please re-enter your password</b><br>The password you entered is incorrect. Please try again (make sure your caps lock is off).";		
		}
	
		
		$txtUser 	= $_POST['txtUser'];
		$txtUser 	= str_replace("'","&acute;",$txtUser);
		$txtPassword=$_POST['txtPassword'];
		$txtPassword= str_replace("'","&acute;",$txtPassword);
		
		$pengacak = "AJWKXLAJSCLWLW";
		$passEnkrip = md5($pengacak . md5($txtPassword) . $pengacak );
	
	
	
	
		if(count($message)==0){	
		    
		    	$loginSql = "SELECT * FROM master_user WHERE email='".$txtUser."' AND password='".$passEnkrip."'";
			$loginQry = mysqli_query($conn,$loginSql)  or die ("Query Periksa Password Salah 1: ".mysqli_error());
			
			
				
			if($loginQry){
				if (mysqli_num_rows($loginQry) >=1) {
					$loginData = mysqli_fetch_array($loginQry);
					$cmbLevel=$loginData['level'];
					
					
			
					$_SESSION['SES_ID_USER'] = $loginData['id_user'];
				$_SESSION['SES_ID'] = $loginData['email'];
				$_SESSION['SES_LOGIN'] = $loginData['first_name'];
			    $_SESSION['SES_LEVEL'] = $loginData['level'];

			
					
					// Refresh
					echo "<meta http-equiv='refresh' content='0;url=index.php?pages=dashboard'>";
				 
				}
				else {
					 echo "<div class='alert alert-warning' role='alert'><b>Sorry!</b> &nbsp incorrect password,Chek your User ID and Password!</div>";
					echo "<meta http-equiv='refresh' content='0; url=login.php?auth=error'>";
				}
			}
		}
		# Jika ada error message ditemukan
		if (! count($message)==0 ){
		?>
            <div class="mssgBox">
			<?php 
			echo "<div class='alert alert-danger' role='alert'>";
				
				foreach ($message as $indeks=>$pesan_tampil) { 
				
					echo "&nbsp;&nbsp;$Num. $pesan_tampil<br>";	
				} 
			echo "</div><div>&nbsp;</div>";?>
            </div>
			<?php 
		}
	}

?>
 
