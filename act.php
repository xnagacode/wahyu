<?php
session_start();
include "config.inc/connect.php";
include "lib/lib_thumb.php";
include "lib/helper.php";


$mod = $_GET[mod];
$act = $_GET[act];

if($mod == "intake" AND $act == "input"){
	$tgl = date("Y-m-d");

	$tgla = $_POST[tanggal];
	$bln = $_POST[bulan];
	$thn = $_POST[tahun];

	$tgl_lahir = "$thn-$bln-$tgla";

	$input = mysql_query("insert into rehab (nama,
											tempat_lahir,
											tgl_lahir,
											alamat,
											no_telp,
											pendidikan,
											anak_ke,
											anak_dari,
											pekerjaan,
											agama,
											suku,
											status_kawin,
											nama_istri,
											nama_anak,
											nama_ayah,
											nama_ibu,
											no_telp_ayah,
											no_telp_ibu,
											alamat_ayah,
											alamat_ibu,
											tahun_pakai,
											drugs_of_choice,
											penyakit_bawaan,
											pernah_kecelakaan,
											hiv,
											gol_darah,
											berat_badan,
											rehab_sebelumnya,
											status,
											petugas,
											tgl_input)
									values('$_POST[nama]',
											'$_POST[tempat_lahir]',
											'$tgl_lahir',
											'$_POST[alamat]',
											'$_POST[telp]',
											'$_POST[pendidikan]',
											'$_POST[anak_ke]',
											'$_POST[anak_dari]',
											'$_POST[pekerjaan]',
											'$_POST[agama]',
											'$_POST[suku]',
											'$_POST[kawin]',
											'$_POST[nm_istri]',
											'$_POST[nm_anak]',
											'$_POST[nm_ayah]',
											'$_POST[nm_ibu]',
											'$_POST[no_ayah]',
											'$_POST[no_ibu]',
											'$_POST[alamat_ayah]',
											'$_POST[alamat_ibu]',
											'$_POST[pakai]',
											'$_POST[drugs]',
											'$_POST[penyakit]',
											'$_POST[tabrak]',
											'$_POST[hiv]',
											'$_POST[darah]',
											'$_POST[berat]',
											'$_POST[sebelum]',
											'$_POST[status]',
											'$_SESSION[nama]',
											'$tgl')");


	if($input == true){
		header("Location: dashboard.php?mod=tmbh$mod&notice=ok");	
	}else {
		header("Location: dashboard.php?mod=tmbh$mod&notice=error");
	}	

}

if($mod == "intake" AND $act == "update"){

	$input = mysql_query("update rehab set 	nama 				= '$_POST[nama]',
											tempat_lahir		= '$_POST[tempat_lahir]',
											alamat 				= '$_POST[alamat]',
											no_telp 			= '$_POST[telp]',
											pendidikan 			= '$_POST[pendidikan]',
											anak_ke				= '$_POST[anak_ke]',	
											anak_dari 			= '$_POST[anak_dari]',
											pekerjaan 			= '$_POST[pekerjaan]',
											agama 				= '$_POST[agama]',
											suku 				= '$_POST[suku]',
											status_kawin 		= '$_POST[kawin]',
											nama_istri 			= '$_POST[nm_istri]',
											nama_anak			= '$_POST[nm_anak]',
											nama_ayah 			= '$_POST[nama_ayah]',
											nama_ibu 			= '$_POST[nama_ibu]',
											no_telp_ayah 		= '$_POST[no_ayah]',
											no_telp_ibu 		= '$_POST[no_ibu]',
											alamat_ayah 		= '$_POST[alamat_ayah]',
											alamat_ibu 			= '$_POST[alamat_ibu]',
											tahun_pakai 		= '$_POST[pakai]',
											drugs_of_choice 	= '$_POST[drugs]' ,
											penyakit_bawaan 	= '$_POST[penyakit]',
											pernah_kecelakaan 	= '$_POST[tabrak]',
											hiv 				= '$_POST[hiv]',
											gol_darah 			= '$_POST[darah]',
											berat_badan 		= '$_POST[berat]',
											rehab_sebelumnya 	= '$_POST[sebelum]',
											status 				= '$_POST[status]'
						where id_resident = $_POST[id]");



	if($input == true){
		header("Location: dashboard.php?mod=edit$mod&id=$_POST[id]&notice=ok");	
	}else {
		header("Location: dashboard.php?mod=edit$mod&id=$_POST[id]&notice=error");
	}	
}

if($mod == "petugas" AND $act == "input"){

	$pass = md5($_POST[nip]);

	$input = mysql_query("insert into petugas(nip,
											  nama,
											  username,
											  password,
											  aktif)
									values('$_POST[nip]',
										   '$_POST[nama]',
										   '$_POST[nip]',
										   '$pass',
										   '$_POST[aktif]')");			

	if($input == true){
		header("Location: dashboard.php?mod=tmbh$mod&notice=ok");	
	}else {
		header("Location: dashboard.php?mod=tmbh$mod&notice=error");
	}	
}

if($mod == "petugas" AND $act == "update"){




		$input = mysql_query("update petugas set nama 		= '$_POST[nama]',
											  	 aktif 		= '$_POST[aktif]'

									where nip = $_POST[id]");
		


	if($input == true){
		header("Location: dashboard.php?mod=edit$mod&id=$_POST[id]&notice=ok");	
	}else {
		header("Location: dashboard.php?mod=edit$mod&id=$_POST[id]&notice=error");
	}	
}

if($mod == "pimpinan" AND $act == "ubah"){

	$input = mysql_query("update pimpinan set nama 		= '$_POST[nama]',
											  nip 		= '$_POST[nip]',
											  jabatan	= '$_POST[jabatan]'

									where id_pimpinan = $_POST[id]");			


	if($input == true){
		header("Location: dashboard.php?mod=ubah$mod&notice=ok");	
	}else {
		header("Location: dashboard.php?mod=ubah$mod&notice=error");
	}	
}

if($mod == "gpass" AND $act == "ubah"){

	$lama 			= md5($_POST[plama]);
	$baru 			= md5($_POST[pbaru]);
	$barukonfirmasi = md5($_POST[kpbaru]);

	$d = mysql_fetch_array(mysql_query("select password from petugas where nama = '$_SESSION[nama]'"));

	if($d[password] != $lama){
		header("Location: dashboard.php?mod=$mod&notice=warning");	
	}else{
		if($baru != $barukonfirmasi){
			header("Location: dashboard.php?mod=$mod&notice=error");
		}else{
			mysql_query("update petugas set password = '$baru'
										where nama = '$_SESSION[nama]'");

			header("Location: dashboard.php?mod=$mod&notice=ok");								
		}
	}
}

if($mod == "rpass" AND $act == "reset"){

	$search_nip = mysql_query("select nip from petugas where nip = '$_POST[nip]' AND nip != '000000'");

	$ada_nip = mysql_num_rows($search_nip);

	if($ada_nip > 0){
		$pass = md5($_POST[nip]);
		$input = mysql_query("update petugas set password  = '$pass'
									where nip = $_POST[nip]");

		if($input == true){
			header("Location: dashboard.php?mod=$mod&notice=ok");	
		}else {
			header("Location: dashboard.php?mod=$mod&notice=error");
		}	

	}else{
		header("Location: dashboard.php?mod=$mod&notice=warning");
	}
}



?>