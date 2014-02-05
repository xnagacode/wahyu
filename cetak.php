<?php
	session_start();
 	// Panggil class ezPdf
 	include ('pdf/cezpdf.php');
  	include "config.inc/connect.php";
  	include "lib/lib_indotgl.php";
  	include "lib/helper.php";

  	if(empty($_SESSION[user]) AND empty($_SESSION[pass])){

		header("Location: logout.php");

	}else {

	  	$mod = $_GET[mod];

	  	if($mod == "resident"){
	  		$pdf = new Cezpdf();
		 	$pdf->selectFont('pdf/fonts/Helvetica.afm');
		  
		 	$pdf->ezSetCmMargins(3.8,3,3,3);

		 	$all = $pdf->openObject();

			$pdf->setStrokeColor(0,0,0,2);
		  	$pdf->addJpegFromFile('pdf/bnp.jpg',40,750,77);
		  	$pdf->addText(130, 815, 16, '<b>BADAN NARKOTIKA NASIONAL PROVINSI ACEH</b>');
		  	$pdf->addText(150, 795, 16, '<b>(NATIONAL NARCOTICS BOARD OF ACEH)</b>');
		  	$pdf->addText(170, 780, 12, 'Jl. Tgk. Daud Beureueh No. 108 Lampriet Banda Aceh');
		  	$pdf->addText(200, 765, 12, 'Telp : (0651) 34883/Fax : (0651) 34917');
		  	$pdf->addText(140, 750, 12, 'e-mail : bnnp_aceh@bnn.go.id/ Website : www.bnp.acehprov.go.id');

		  	$pdf->line(10, 743, 585, 743);

			$pdf->closeObject();

			$pdf->addObject($all, 'all');



			$pdf->selectFont('pdf/fonts/Times-Roman.afm');

			$sql = mysql_query("select * from rehab where id_resident ='$_GET[id]'");


			$n = mysql_fetch_array($sql);

			$tgl = tgl_indo($n[tgl_lahir]);

			$a = mysql_fetch_array(mysql_query("select pendidikan from pendidikan where id_pendidikan = '$n[pendidikan]'"));
			$pendidikan =  $a[pendidikan]; 

			$b = mysql_fetch_array(mysql_query("select agama from agama where id_agama = '$n[agama]'"));
			$agama =  $b[agama];

			$c = mysql_fetch_array(mysql_query("select drugs from drugs where id_drugs = '$n[drugs_of_choice]'"));
			$drug =  $c[drugs];  

			$d = mysql_fetch_array(mysql_query("select darah from darah where id_darah = '$n[gol_darah]'"));
			$darah =  $d[darah]; 

			$status = $n[status] == "N" ? "New Comer" : "Relapser";

			$data[] = array('item'=> "Nama",'isi'=>": $n[nama]");
			$data[] = array('item'=> "Tempat/Tanggal Lahir",'isi'=>": $n[tempat_lahir]/$tgl");
			$data[] = array('item'=> "Alamat", 'isi'=>": $n[alamat]");
			$data[] = array('item'=> "No Telp", 'isi'=>": $n[no_telp]");
			$data[] = array('item'=> "Pendidikan Terakhir", 'isi'=>": $pendidikan");
			$data[] = array('item'=> "Anak ke - dari", 'isi'=>": $n[anak_ke] dari $n[anak_dari] bersaudara");
			$data[] = array('item'=> "Pekerjaan", 'isi'=>": $n[pekerjaan]");
			$data[] = array('item'=> "Agama", 'isi'=>": $agama");
			$data[] = array('item'=> "Suku", 'isi'=>": $n[suku]");
			$data[] = array('item'=> "Status Perkawinan", 'isi'=>": $n[status_kawin]");
			$data[] = array('item'=> "Nama Istri", 'isi'=>": $n[nama_istri]");
			$data[] = array('item'=> "Nama Anak", 'isi'=>": $n[nama_anak]");
			$data[] = array('item'=> "Nama Ayah", 'isi'=>": $n[nama_ayah]");
			$data[] = array('item'=> "Nama Ibu", 'isi'=>": $n[nama_ayah]");
			$data[] = array('item'=> "No Telp Ayah", 'isi'=>": $n[no_telp_ayah]");
			$data[] = array('item'=> "No Telp Ibu", 'isi'=>": $n[no_telp_ibu]");
			$data[] = array('item'=> "Alamat Ayah",'isi'=>": $n[alamat_ayah]");
			$data[] = array('item'=> "Alamat Ibu", 'isi'=>": $n[alamat_ibu]");
			$data[] = array('item'=> "Pertama Kali Pakai", 'isi'=>": $n[tahun_pakai]");
			$data[] = array('item'=> "Drugs of Choice", 'isi'=>": $drug");
			$data[] = array('item'=> "Rehab Sebelumnya", 'isi'=>": $n[rehab_sebelumnya]");
			$data[] = array('item'=> "Penyakit Bawaan", 'isi'=>": $n[penyakit_bawaan]");
			$data[] = array('item'=> "Pernah Kecelakaan", 'isi'=>": $n[pernah_kecelakaan]");
			$data[] = array('item'=> "HIV / HCV", 'isi'=>": $n[hiv]");
			$data[] = array('item'=> "Golongan Darah", 'isi'=>": $darah");
			$data[] = array('item'=> "Berat Badan", 'isi'=>": $n[berat_badan] kg");
			$data[] = array('item'=> "Status", 'isi'=>": $status");

			
			$pdf->ezTable($data, array("item" => "", "isi" => ""), "<b>Resident Intake</b>", array('shaded' => 0, 'showLines' => 0, 'width' => 500));

			$tgl_s = tgl_indo(date("Y-m-d"));

			$pdf->ezText("\n\nBanda Aceh, $tgl_s", 10);
			$pdf->ezText("Diisi Oleh,                                                                         Diketahui Oleh,", 10);

			$pimpinan = mysql_fetch_array(mysql_query("select * from pimpinan where id_pimpinan = '1'"));


			$pdf->ezText("\n\n\n(Petugas Harian)                                                             ($pimpinan[jabatan])", 10);
			$pdf->ezText("\n\n\n\n\n<b>...................</b>                                                                     <u>$pimpinan[nama]</u>", 10);
			$pdf->ezText("                                                                                        NIP. $pimpinan[nip]", 10);



		  	$pdf->ezStream(array("Content-Disposition"=>"resident_intake_$n[nama].pdf"));
	  	}
	  	else if($mod == "rekap"){

	  		$pdf = new Cezpdf();
		 	$pdf->selectFont('pdf/fonts/Helvetica.afm');
		  
		 	$pdf->ezSetCmMargins(3.8,3,3,3);

		 	$all = $pdf->openObject();

			$pdf->setStrokeColor(0,0,0,2);
		  	$pdf->addJpegFromFile('pdf/bnp.jpg',40,750,77);
		  	$pdf->addText(130, 815, 16, '<b>BADAN NARKOTIKA NASIONAL PROVINSI ACEH</b>');
		  	$pdf->addText(150, 795, 16, '<b>(NATIONAL NARCOTICS BOARD OF ACEH)</b>');
		  	$pdf->addText(170, 780, 12, 'Jl. Tgk. Daud Beureueh No. 108 Lampriet Banda Aceh');
		  	$pdf->addText(200, 765, 12, 'Telp : (0651) 34883/Fax : (0651) 34917');
		  	$pdf->addText(140, 750, 12, 'e-mail : bnnp_aceh@bnn.go.id/ Website : www.bnp.acehprov.go.id');

		  	$pdf->line(10, 743, 585, 743);

			$pdf->closeObject();

			$pdf->addObject($all, 'all');

			$pdf->selectFont('pdf/fonts/Times-Roman.afm');

			$sql = mysql_query("select * from rehab where monthname(tgl_input) = '$_GET[bulan]' AND year(tgl_input) = '$_GET[tahun]'");
			$by = mysql_num_rows($sql);
			$i = 1;

			while($n = mysql_fetch_array($sql)){
				$sf = mysql_fetch_array(mysql_query("select drugs from drugs where id_drugs = '$n[drugs_of_choice]'"));
				$narkoba =  $sf[drugs];

				if($n[status] == "N"){
					$status = "New Comer";
				}else{
					$status =  "Relapser";
				}


				$data[$i] = array(
						"<b>No</b>" 				=> $i,
						"<b>NAMA</b>"				=> $n['nama'],
						"<b>Alamat</b>"				=> $n['alamat'],
						"<b>No Telp</b>"			=> $n['no_telp'],
						"<b>Pekerjaan</b>"			=> $n['pekerjaan'],
						"<b>Jenis Narkoba</b>"		=> $narkoba,
						"<b>Status</b>"				=> $status
					);
				$i++;
			}

			$pdf->ezText("Laporan Resident Intake\n", 18, array('justification' => 'center'));

			$pdf->ezText("Bulan                 : $_GET[bulan]", 12);
			$pdf->ezText("Tahun                 : $_GET[tahun]", 12);
			$pdf->ezText("Jumlah Pecandu : $by orang\n\n", 12);


			$pdf->ezTable($data, '', '', array('shaded' => 0, 'showLines' => 2));

			$pdf->ezStream(array("Content-Disposition"=>"Laporan_resident_intake_$_GET[bulan]_$_GET[tahun].pdf"));
	  	}
	  	else{
	  		header("Location: logout.php");
	  	}
	}

?>