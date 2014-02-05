<?php
session_start();

if(!empty($_SESSION[user]) AND !empty($_SESSION[pass])){
	header("Location: dashboard.php?mod=dashboard");
}else{
?>	

	<!DOCTYPE html>
	<html>
	<head>
		<title>BNP Aceh</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	<body>
		<div id="container">
			<div id="heading">
				<span class="icon-bnp"></span>BNP Aceh
			</div>
			<div id="box">
				<form action="cek.php" method="post">
					<table class="table-form">
						<tr>
							<td style="width: 150px;">Username</td>
							<td>
								<input type="text" class="txt" maxlength="30"  name="user" required>
							</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>
								<input type="password" class="txt" maxlength="30" name="pass" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<?php
									if($_GET[nof] == "err"){
										?>
											<p class="error">Username dan atau password Anda salah. Coba ulangi lagi !!!</p>
										<?php
									}

									if($_GET[nof] == "danied"){
										?>
											<p class="error">Akses Anda tidak dibolehkan</p>
										<?php
									}

								?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" value="Login" class="tombol">
								<input type="reset" value="Reset" class="tombol">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
	</html>
<?php
}
?>