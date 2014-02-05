<?php
include "config.inc/connect.php";
include "lib/helper.php";

$user     = anti_injection($_POST[user]);
$pass     = anti_injection(md5($_POST[pass]));

if (!ctype_alnum($user) OR !ctype_alnum($pass)){
	header('Location: index.php?nof=danied');
}
else{
	$login=mysql_query("select * from petugas where username='$user' AND password='$pass' AND aktif !='N'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);

	// Apabila username dan password ditemukan
	if ($ketemu > 0){
		session_start();
		
		session_register("user");
		session_register("pass");
		session_register("nama");
		session_register("level");
		
		
		$_SESSION[user] = $r[username];
		$_SESSION[pass] = $r[password];
		$_SESSION[nama] = $r[nama];
		$_SESSION[level] = $r[level];

		$sid_lama = session_id();
	
		session_regenerate_id();

		$sid_baru = session_id();
		
		mysql_query("update petugas set id_session = '$sid_baru' where username = '$user'");
	
		
		header("Location: dashboard.php?mod=home");
	}
	else{
		header('Location: index.php?nof=err');
	}
}



?>