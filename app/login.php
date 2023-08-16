<?php 
session_start();
 
include ('koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];
 

$login = mysqli_query($conn,"select * from tb_login where username='$username' and password='$password'");

$cek = mysqli_num_rows($login);

if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);

	if($data['role']=="admin"){

		$_SESSION['username'] = $username;
		$_SESSION['role'] = "admin";

		header("location:../app/admin");

	}else if($data['role']=="ppic"){

		$_SESSION['username'] = $username;
		$_SESSION['role'] = "ppic";

		header("location:../app/ppic");
 

	}else if($data['role']=="purchasing"){

		$_SESSION['username'] = $username;
		$_SESSION['role'] = "purchasing";

		header("location:../app/purchasing");
 
	}else if($data['role']=="gudang"){

		$_SESSION['username'] = $username;
		$_SESSION['role'] = "gudang";

		header("location:../app/gudang");
	}else if($data['role']=="produksi"){

		$_SESSION['username'] = $username;
		$_SESSION['role'] = "produksi";

		header("location:../app/produksi");
	}else if($data['role']=="pengiriman"){

		$_SESSION['username'] = $username;
		$_SESSION['role'] = "pengiriman";

		header("location:../app/pengiriman");
	}
    }else if ($username == '' || $password == '') {
 
		header("location:../index.php?error=2");
	}	else if ($username != $username && $password != $password){
	header("location:../index.php?error=1");
}
      

        
        // if (mysqli_num_rows($query) == 1) {
        //     $_SESSION['login'] = true;
        //     $_SESSION['username'] = $username;
        //     header("Location:../app/admin");
        // } else if ($username == '' || $password == '') {
        //     header("Location:../index.php?error=2");
        // } else {
        //     header("Location:../index.php?error=1");
        // }

        // if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        //     // last request was more than 30 minutes ago
        //     session_unset();     // unset $_SESSION variable for the run-time 
        //     session_destroy();   // destroy session data in storage
        //     }
        //     $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
