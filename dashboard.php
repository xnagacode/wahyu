<?php
session_start();

include "config.inc/connect.php";

if(empty($_SESSION[user]) AND empty($_SESSION[pass])){

	header("Location: index.php?nof=danied");
	

}else {
?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>BNP Aceh</title>
		<link rel="stylesheet" type="text/css" href="css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="css/custom-theme/jquery-ui-1.10.3.custom.css">

		<script type="text/javascript" src="jquery/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="jquery/jquery-ui-1.10.3.custom.js"></script>

	</head>
	<body>
	<div id="container">
		<div id="menu_wrap">
			<nav>
				<ul>
					<li><span class="icon-bnp"></span></li>
					<?php
						if($_SESSION[level] == "A"){
							?>
								<li><a href="#"><span class="icon-add"></span>Tambah</a>
									<ul>
										<li><a href="dashboard.php?mod=tmbhintake"><span class="icon-item"></span>Resident Intake</a></li>
										<li><a href="dashboard.php?mod=ubahpimpinan"><span class="icon-item"></span>Pimpinan</a></li>
										<li><a href="dashboard.php?mod=tmbhpetugas"><span class="icon-item"></span>Petugas</a></li>
										<li><a href="dashboard.php?mod=rpass"><span class="icon-item"></span>Reset Password</a></li>
										<li><a href="dashboard.php?mod=gpass"><span class="icon-item"></span>Ganti Password</a></li>
									</ul>
								</li>
								<li><a href="#"><span class="icon-data"></span>Data</a>
									<ul>
										<li><a href="dashboard.php?mod=dintake"><span class="icon-item"></span>Resident Intake</a></li>
										<li><a href="dashboard.php?mod=dpimpinan"><span class="icon-item"></span>Pimpinan</a></li>
										<li><a href="dashboard.php?mod=dpetugas"><span class="icon-item"></span>Petugas</a></li>
									</ul>
								</li>
								<li><a href="#"><span class="icon-report"></span>Rekap</a>
									<ul>
										<li><a href="dashboard.php?mod=lintake"><span class="icon-item"></span>Resident Intake</a></li>
									
									</ul>
								</li>
								<li><a href="dashboard.php?mod=cari"><span class="icon-cari"></span>Pencarian</a></li>


							<?php
						}else{
							?>
								<li><a href="#"><span class="icon-add"></span>Tambah</a>
									<ul>
										<li><a href="dashboard.php?mod=tmbhintake"><span class="icon-item"></span>Resident Intake</a></li>
										<li><a href="dashboard.php?mod=gpass"><span class="icon-item"></span>Ganti Password</a></li>
									</ul>
								</li>
								<li><a href="#"><span class="icon-data"></span>Data</a>
									<ul>
										<li><a href="dashboard.php?mod=dintake"><span class="icon-item"></span>Resident Intake</a></li>
										<li><a href="dashboard.php?mod=dpimpinan"><span class="icon-item"></span>Pimpinan</a></li>
									</ul>
								</li>
								<li><a href="#"><span class="icon-report"></span>Rekap</a>
									<ul>
										<li><a href="dashboard.php?mod=lintake"><span class="icon-item"></span>Resident Intake</a></li>
									
									</ul>
								</li>
								<li><a href="dashboard.php?mod=cari"><span class="icon-cari"></span>Pencarian</a></li>
							<?php
						}
					?>
					
				</ul>
			</nav>
			<div id="keluar">
				<a href="logout.php">Keluar</a>
			</div>
		</div>
		<div id="content_wrap">
			<?php include "content.php"; ?>	
		</div>
		
	</div>
	<div id="footer">
		<div id="box">
			<p>Login sebagai : <b><?php echo $_SESSION[nama];  ?></b> &nbsp;&nbsp;&nbsp;&nbsp;<b>--</b> &nbsp;&nbsp;&nbsp;&nbsp; Hak Akses : <b>
																																				<?php
																																					if($_SESSION[level] == "A"){
																																						echo "Admin";
																																					}else{
																																						echo "Petugas";
																																					}
																																				?>
																																			 </b></p>
		</div>
	</div>
		<script type="text/javascript">
			$(function(){
				$('#datepicker').datepicker();
				$('#datepicker').datepicker("option", "dateFormat", "yy-mm-dd");
			});
		</script>
	</body>
	</html>

<?php
}
?>