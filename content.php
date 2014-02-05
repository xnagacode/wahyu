 <?php
session_start();
include "config.inc/connect.php";
include "lib/lib_thumb.php";
include "lib/helper.php";
include "lib/lib_paging.php";
include "lib/lib_indotgl.php";
include "lib/lib_combobox.php";


	$mod = $_GET[mod];

	$act = $_GET[act];

	if($mod == "home"){
		?>
			<div class="box">
				<h2>Selamat datang di aplikasi Resident Intake BNP Aceh</h2>
				<p>
					Aplikasi ini merupakan aplikasi <i>Registrasi Resident Intake</i> berbasis <b>web</b> yang 
					digunakan untuk mengelola data para pecandu narkoba untuk direhabilitasi pada unit rehabilitasi Badan Narkotika Provinsi Aceh 
				</p>
				<p>
					Sekilas Tentang Fungsi aplikasi :

					<ul>
						<li><b>Menambah data :</b>
							<ol>
								<li>Resident Intake</li>
								<li>Pimpinan</li>
								<li>Petugas Harian</li>
							</ol>
						</li>
						<li><b>Merekap Data Resident Intake per hari dan perbulan</b></li>
						<li><b>Mencari Data Resident Intake</b></li>
					</ul>
				</p>
			</div>
		<?php
	}
	else if($mod == "tmbhintake"){
		?>
			<div class="box">
				<h2>Tambah Resident Intake</h2>
				<?php
					if($_GET[notice] == "ok"){
						?>
							<fieldset class="ok">
								Data Berhasil ditambah
							</fieldset>
						<?php
					}

					if($_GET[notice] == "error"){
						?>
							<fieldset class="error">
								Data gagal Di tambah, mohon periksa lagi data yang di isi
							</fieldset>
						<?php
					}

					if($_GET[notice] == "warning"){
						?>
							<fieldset class="warning">
								Data ada yang error
							</fieldset>
						<?php
					}

				?>
				<table class="table-form">
					<form action="act.php?mod=intake&act=input" method="post">
						<tr>
							<td>Nama</td>
							<td>
								<input type="text" name="nama" class="txt" style="width:450px;" required>					
							</td>				
						</tr>
						<tr>
							<td>Tempat Lahir</td>
							<td>
								<input type="text" name="tempat_lahir" class="txt" style="width:400px;" required>					
							</td>				
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>
								<?php
									combotgl(1, 31, 'tanggal', $tgl_skrg);
									combonamabln(1, 12, 'bulan', $bln_sekarang);
									combothn(1970, $thn_sekarang, 'tahun', $thn_sekarang);
								?>		
							</td>				
						</tr>
						<tr>
							<td>Alamat</td>
							<td>
								<textarea name="alamat" class="txarea" style="width:450px;" required></textarea>				
							</td>				
						</tr>
						<tr>
							<td>No Telp</td>
							<td>
								<input type="text" name="telp" class="txt" required>					
							</td>				
						</tr>
						<tr>
							<td>Pendidikan</td>
							<td>
								<select name="pendidikan" class="txt" required>
									<option value="" selected>pilih salah satu</option>
									<?php
										$p = mysql_query("select * from pendidikan");

										while ($pa = mysql_fetch_array($p)) {
											?>
												<option value="<?php  echo $pa[id_pendidikan]; ?>" ><?php echo $pa[pendidikan]; ?></option>
											<?php
										}
									?>
								</select>					
							</td>				
						</tr>
						<tr>
							<td>Anak Ke</td>
							<td>
								<input type="text" name="anak_ke" class="txt" style="width:50px;" required>
								 Dari
								<input type="text" name="anak_dari" class="txt" style="width:50px;" required> Bersaudara	
							</td>				
						</tr>
						<tr>
							<td>Pekerjaan</td>
							<td>
								<input type="text" name="pekerjaan" class="txt" style="width:450px;" required>					
							</td>				
						</tr>
						<tr>
							<td>Agama</td>
							<td>
								<select name="agama" class="txt" required>
									<option value="" selected="">pilih agama</option>
									<?php
										$a = mysql_query("select * from agama");

										while ($d = mysql_fetch_array($a)) {
											?>
												<option value="<?php  echo $d[id_agama]; ?>" ><?php echo $d[agama]; ?></option>
											<?php
										}
									?>
								</select>					
							</td>				
						</tr>
						<tr>
							<td>Suku</td>
							<td>
								<input type="text" name="suku" class="txt">					
							</td>				
						</tr>
						<tr>
							<td>Status Perkawinan</td>
							<td>
								<input type="radio" name="kawin" value="Kawin" required>Kawin
								<input type="radio" name="kawin" value="Belum Kawin">Belum Kawin					
							</td>				
						</tr>
						<tr>
							<td>Nama Istri</td>
							<td>
								<input type="text" name="nm_istri" class="txt" style="width:450px;">					
							</td>				
						</tr>
						<tr>
							<td>Nama Anak</td>
							<td>
								<input type="text" name="nm_anak" class="txt" style="width:450px;">					
							</td>				
						</tr>
						<tr>
							<td>Nama Ayah</td>
							<td>
								<input type="text" name="nm_ayah" class="txt" style="width:450px;">					
							</td>				
						</tr>
						<tr>
							<td>Nama Ibu</td>
							<td>
								<input type="text" name="nm_ibu" class="txt" style="width:450px;">					
							</td>				
						</tr>
						<tr>
							<td>No Telp Ayah</td>
							<td>
								<input type="text" name="no_ayah" class="txt" style="width:450px;">					
							</td>				
						</tr>
						<tr>
							<td>No Telp Ibu</td>
							<td>
								<input type="text" name="no_ibu" class="txt" style="width:450px;">					
							</td>				
						</tr>
						<tr>
							<td>Alamat Ayah</td>
							<td>
								<textarea name="alamat_ayah" class="txarea" style="width:450px;"></textarea>				
							</td>				
						</tr>
						<tr>
							<td>Alamat Ibu</td>
							<td>
								<textarea name="alamat_ibu" class="txarea" style="width:450px;"></textarea>				
							</td>				
						</tr>
						<tr>
							<td>Pertama Kali Pakai</td>
							<td>
								<input type="text" name="pakai" class="txt" style="width:100px;" maxlength="4" required>					
							</td>				
						</tr>
						<tr>
							<td>Drugs of Choice</td>
							<td>
								<select name="drugs" class="txt" required>
									<option value="" selected>pilih salah satu</option>
									<?php
										$d = mysql_query("select * from drugs order by drugs asc");

										while($a = mysql_fetch_array($d)){
											?>
												<option value="<?php echo $a[id_drugs]; ?>"><?php  echo $a[drugs]; ?></option>
											<?php
										}
									?>
								</select>					
							</td>				
						</tr>
						<tr>
							<td>Rehab Sebelumnya</td>
							<td>
								<input type="text" name="sebelum" class="txt" >					
							</td>				
						</tr>
						<tr>
							<td>Penyakit Bawaan</td>
							<td>
								<input type="text" name="penyakit" class="txt" >					
							</td>				
						</tr>
						<tr>
							<td>Pernah Kecelakaan</td>
							<td>
								<input type="radio" name="tabrak" value="Ya" required>Ya	
								<input type="radio" name="tabrak" value="Tidak">Tidak					
							</td>				
						</tr>
						<tr>
							<td>HIV / HCV</td>
							<td>
								<input type="text" name="hiv" class="txt" style="width:100px;" maxlength="3">					
							</td>				
						</tr>
						<tr>
							<td>Golongan Darah</td>
							<td>
								<select name="darah" class="txt" required>
									<option value="" selected>Pilih darah</option>
									<?php
										$dr = mysql_query("select * from darah");

										while($e = mysql_fetch_array($dr)){
											?>
												<option value="<?php echo $e[id_darah]; ?>"><?php echo $e[darah]; ?></option>
											<?php
										}
									?>
									
								</select>						
							</td>				
						</tr>
						<tr>
							<td>Berat Badan</td>
							<td>
								<input type="text" name="berat" class="txt" style="width:50px;" maxlength="3"> Kg				
							</td>				
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<input type="radio" name="status" value="N" required>New Comer				
								<input type="radio" name="status" value="R">Relapser
							</td>				
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="button" class="tombol" value="kembali" onClick='window.location ="dashboard.php?mod=home"'><input type="submit" value="Simpan" class="tombol">					
							</td>				
						</tr>
					</form>
				</table>
			</div>	
		<?php
	}

	else if($mod == "editintake"){
		$sql = mysql_query("select * from rehab where id_resident = '$_GET[id]'");
		$e = mysql_fetch_array($sql);

		?>
			<div class="box">
				<h2>Edit Resident Intake</h2>
				<?php
					if($_GET[notice] == "ok"){
						?>
							<fieldset class="ok">
								Data berhasil diubah
							</fieldset>
						<?php
					}

					if($_GET[notice] == "error"){
						?>
							<fieldset class="error">
								Data gagal diubah, mohon periksa lagi data yang di isi
							</fieldset>
						<?php
					}

					if($_GET[notice] == "warning"){
						?>
							<fieldset class="warning">
								Data ada yang error
							</fieldset>
						<?php
					}

				?>
				<table class="table-form">
					<form action="act.php?mod=intake&act=update" method="post">
						<input type="hidden" name="id" value="<?php echo $e[id_resident]; ?>" >
						<tr>
							<td>Nama</td>
							<td>
								<input type="text" name="nama" class="txt" style="width:450px;" required value="<?php echo $e[nama]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Tempat Lahir</td>
							<td>
								<input type="text" name="tempat_lahir" class="txt" style="width:400px;" required value="<?php echo $e[tempat_lahir]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Alamat</td>
							<td>
								<textarea name="alamat" class="txarea" style="width:450px;" required><?php echo $e[alamat]; ?></textarea>				
							</td>				
						</tr>
						<tr>
							<td>No Telp</td>
							<td>
								<input type="text" name="telp" class="txt" required value="<?php echo $e[no_telp]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Pendidikan</td>
							<td>
								<select name="pendidikan" class="txt" required>
									<option value="" selected>pilih salah satu</option>
									<?php
										$p = mysql_query("select * from pendidikan");

										while ($pa = mysql_fetch_array($p)) {
											if($e[pendidikan] == $pa[id_pendidikan]){
												?>
													<option value="<?php  echo $pa[id_pendidikan]; ?>" selected><?php echo $pa[pendidikan]; ?></option>
												<?php
											}else{
												?>
													<option value="<?php  echo $pa[id_pendidikan]; ?>" ><?php echo $pa[pendidikan]; ?></option>
												<?php
											}
											
										}
									?>
								</select>					
							</td>				
						</tr>
						<tr>
							<td>Anak Ke</td>
							<td>
								<input type="text" name="anak_ke" class="txt" style="width:50px;" required value="<?php echo $e[anak_ke]; ?>">
								 Dari
								<input type="text" name="anak_dari" class="txt" style="width:50px;" required value="<?php echo $e[anak_dari]; ?>"> Bersaudara	
							</td>				
						</tr>
						<tr>
							<td>Pekerjaan</td>
							<td>
								<input type="text" name="pekerjaan" class="txt" style="width:450px;" required value="<?php echo $e[pekerjaan]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Agama</td>
							<td>
								<select name="agama" class="txt" required>
									<option value="" selected="">pilih agama</option>
									<?php
										$a = mysql_query("select * from agama");

										while ($d = mysql_fetch_array($a)) {
											if($e[agama] == $d[id_agama]){
													?>
													<option value="<?php  echo $d[id_agama]; ?>" selected><?php echo $d[agama]; ?></option>
												<?php
											}else{
												?>
													<option value="<?php  echo $d[id_agama]; ?>" ><?php echo $d[agama]; ?></option>
												<?php
											}
										}
									?>
								</select>					
							</td>				
						</tr>
						<tr>
							<td>Suku</td>
							<td>
								<input type="text" name="suku" class="txt" value="<?php echo $e[suku]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Status Perkawinan</td>
							<td>
								<?php
									if($e[status_kawin] == "Kawin"){
										?>
											<input type="radio" name="kawin" value="Kawin" required checked>Kawin
											<input type="radio" name="kawin" value="Belum Kawin">Belum Kawin	
										<?php
									}else{
										?>
											<input type="radio" name="kawin" value="Kawin" required>Kawin
											<input type="radio" name="kawin" value="Belum Kawin" checked>Belum Kawin	
										<?php
									}
								?>
												
							</td>				
						</tr>
						<tr>
							<td>Nama Istri</td>
							<td>
								<input type="text" name="nm_istri" class="txt" style="width:450px;" value="<?php echo $e[nama_istri]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Nama Anak</td>
							<td>
								<input type="text" name="nm_anak" class="txt" style="width:450px;" value="<?php echo $e[nama_anak]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Nama Ayah</td>
							<td>
								<input type="text" name="nm_ayah" class="txt" style="width:450px;" value="<?php echo $e[nama_ayah]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Nama Ibu</td>
							<td>
								<input type="text" name="nm_ibu" class="txt" style="width:450px;" value="<?php echo $e[nama_ibu]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>No Telp Ayah</td>
							<td>
								<input type="text" name="no_ayah" class="txt" style="width:450px;" value="<?php echo $e[no_telp_ayah]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>No Telp Ibu</td>
							<td>
								<input type="text" name="no_ibu" class="txt" style="width:450px;" value="<?php echo $e[no_telp_ibu]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Alamat Ayah</td>
							<td>
								<textarea name="alamat_ayah" class="txarea" style="width:450px;"><?php echo $e[alamat_ayah]; ?></textarea>				
							</td>				
						</tr>
						<tr>
							<td>Alamat Ibu</td>
							<td>
								<textarea name="alamat_ibu" class="txarea" style="width:450px;"><?php echo $e[alamat_ibu]; ?></textarea>				
							</td>				
						</tr>
						<tr>
							<td>Pertama Kali Pakai</td>
							<td>
								<input type="text" name="pakai" class="txt" style="width:100px;" maxlength="4" required value="<?php echo $e[tahun_pakai]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Drugs of Choice</td>
							<td>
								<select name="drugs" class="txt" required>
									<option value="" selected>pilih salah satu</option>
									<?php
										$d = mysql_query("select * from drugs order by drugs asc");

										while($a = mysql_fetch_array($d)){
											if($e[drugs_of_choice] == $a[id_drugs]){
												?>
													<option value="<?php echo $a[id_drugs]; ?>" selected><?php  echo $a[drugs]; ?></option>
												<?php
											}else{
												?>
													<option value="<?php echo $a[id_drugs]; ?>"><?php  echo $a[drugs]; ?></option>
												<?php
											}
											
										}
									?>
								</select>					
							</td>				
						</tr>
						<tr>
							<td>Rehab Sebelumnya</td>
							<td>
								<input type="text" name="sebelum" class="txt" value="<?php echo $e[rehab_sebelumnya]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Penyakit Bawaan</td>
							<td>
								<input type="text" name="penyakit" class="txt" value="<?php echo $e[penyakit_bawaan]; ?>" >					
							</td>				
						</tr>
						<tr>
							<td>Pernah Kecelakaan</td>
							<td>
								<?php
									if($e[pernah_kecelakaan] == "Ya"){
										?>
											<input type="radio" name="tabrak" value="Ya" required checked>Ya	
											<input type="radio" name="tabrak" value="Tidak">Tidak
										<?php
									}else{
										?>
											<input type="radio" name="tabrak" value="Ya" required>Ya	
											<input type="radio" name="tabrak" value="Tidak" checked>Tidak
										<?php
									}
								?>
													
							</td>				
						</tr>
						<tr>
							<td>HIV / HCV</td>
							<td>
								<input type="text" name="hiv" class="txt" style="width:100px;" maxlength="3" value="<?php echo $e[hiv]; ?>">					
							</td>				
						</tr>
						<tr>
							<td>Golongan Darah</td>
							<td>
								<select name="darah" class="txt" required>
									<option value="" selected>Pilih darah</option>
									<?php
										$dr = mysql_query("select * from darah");

										while($ed = mysql_fetch_array($dr)){
											if($e[gol_darah] == $ed[id_darah]){
												?>
													<option value="<?php echo $ed[id_darah]; ?>" selected><?php echo $ed[darah]; ?></option>
												<?php
											}else{
												?>
													<option value="<?php echo $ed[id_darah]; ?>"><?php echo $ed[darah]; ?></option>
												<?php
											}
											
										}
									?>
									
								</select>						
							</td>				
						</tr>
						<tr>
							<td>Berat Badan</td>
							<td>
								<input type="text" name="berat" class="txt" style="width:50px;" maxlength="3"  value="<?php echo $e[berat_badan]; ?>"> Kg				
							</td>				
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<?php
									if($e[status] == "N"){
										?>
											<input type="radio" name="status" value="N" required checked>New Comer				
											<input type="radio" name="status" value="R">Relapser
										<?php
									}else{
										?>
											<input type="radio" name="status" value="N" required>New Comer				
											<input type="radio" name="status" value="R" checked>Relapser
										<?php
									}
								?>
								
							</td>				
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="button" class="tombol" value="kembali" onClick='window.location ="dashboard.php?mod=dintake"'><input type="submit" value="Simpan" class="tombol">					
							</td>				
						</tr>
					</form>
				</table>
			</div>	
		<?php
	}
	else if($mod == "ubahpimpinan"){
		if($_SESSION[level] == "A"){

			$sql = mysql_query("select * from pimpinan where id_pimpinan = '1'");
			$e = mysql_fetch_array($sql);


			?>
				<div class="box">
					<h2>Tambah pimpinan</h2>
					<?php
						if($_GET[notice] == "ok"){
							?>
								<fieldset class="ok">
									Data Berhasil diperbaharui
								</fieldset>
							<?php
						}

						if($_GET[notice] == "error"){
							?>
								<fieldset class="error">
									Data gagal Diperbaharui, mohon periksa lagi data yang di isi
								</fieldset>
							<?php
						}

						if($_GET[notice] == "warning"){
							?>
								<fieldset class="warning">
									Data ada yang error
								</fieldset>
							<?php
						}

					?>
					<table class="table-form">
						<form action="act.php?mod=pimpinan&act=ubah" method="post">
							<input type="hidden" name="id" value="<?php echo $e[id_pimpinan]; ?>"
							<tr>
								<td>Nama</td>
								<td>
									<input type="text" name="nama" class="txt" style="width:350px;" value="<?php echo $e[nama]; ?>">					
								</td>				
							</tr>
							<tr>
								<td>NIP</td>
								<td>
									<input type="text" name="nip" class="txt" style="width:350px;" value="<?php echo $e[nip]; ?>">					
								</td>				
							</tr>
							<tr>
								<td>Jabatan</td>
								<td>
									<input type="text" name="jabatan" class="txt" style="width:450px;" value="<?php echo $e[jabatan]; ?>">					
								</td>				
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="button" class="tombol" value="kembali" onClick="self.history.back()"><input type="submit" value="Ubah" class="tombol">					
								</td>				
							</tr>
						</form>
					</table>
				</div>
			<?php

		}else{
			header("Location: logout.php");
		}

		
	}
	else if($mod == "tmbhpetugas"){
		if($_SESSION[level] == "A"){

			?>
				<div class="box">
					<h2>Tambah Petugas</h2>
					<?php
						if($_GET[notice] == "ok"){
							?>
								<fieldset class="ok">
									Data Berhasil ditambah
								</fieldset>
							<?php
						}

						if($_GET[notice] == "error"){
							?>
								<fieldset class="error">
									Data gagal Di tambah, mohon periksa lagi data yang di isi
								</fieldset>
							<?php
						}

						if($_GET[notice] == "warning"){
							?>
								<fieldset class="warning">
									Data ada yang error
								</fieldset>
							<?php
						}

					?>
					<table class="table-form">
						<form action="act.php?mod=petugas&act=input" method="post">
							<tr>
								<td>Nama</td>
								<td>
									<input type="text" name="nama" class="txt" style="width:350px;">					
								</td>				
							</tr>
							<tr>
								<td>NIP</td>
								<td>
									<input type="text" name="nip" class="txt" style="width:350px;">					
								</td>				
							</tr>
							<tr>
								<td>Aktif</td>
								<td>
									<input type="radio" name="aktif" value="Y">YA
									<input type="radio" name="aktif" value="N">TIDAK
								</td>
							</tr>	
							<tr>
								<td></td>
								<td>
									<input type="button" class="tombol" value="kembali" onClick='window.location ="dashboard.php?mod=home"'><input type="submit" value="Simpan" class="tombol">					
								</td>				
							</tr>
						</form>
					</table>
				</div>
			<?php

		}else{
			header("Location: logout.php");
		}
	}

	else if($mod == "editpetugas"){

		$sql = mysql_query("select * from petugas where nip='$_GET[id]'");
		$e = mysql_fetch_array($sql);

		if($_SESSION[level] == "A"){

			?>
				<div class="box">
					<h2>Edit Petugas</h2>
					<?php
						if($_GET[notice] == "ok"){
							?>
								<fieldset class="ok">
									Data Berhasil diubah
								</fieldset>
							<?php
						}

						if($_GET[notice] == "error"){
							?>
								<fieldset class="error">
									Data gagal diubah, mohon periksa lagi data yang di isi
								</fieldset>
							<?php
						}

						if($_GET[notice] == "warning"){
							?>
								<fieldset class="warning">
									Data ada yang error
								</fieldset>
							<?php
						}

					?>
					<table class="table-form">
						<form action="act.php?mod=petugas&act=update" method="post">
							<input type="hidden" name="id" value="<?php echo $e[nip]; ?>">
							<tr>
								<td>Nama</td>
								<td>
									<input type="text" name="nama" class="txt" style="width:350px;" value="<?php echo $e[nama]; ?>">					
								</td>				
							</tr>
							<tr>
								<td>NIP</td>
								<td>
									<input type="text" name="nip" class="txt" style="width:350px;" value="<?php echo $e[nip]; ?>" readonly>					
								</td>				
							</tr>
							<tr>
								<td>Aktif</td>
								<td>
									<?php
										if($e[aktif] == "Y"){
											?>
												<input type="radio" name="aktif" value="Y" checked>YA
												<input type="radio" name="aktif" value="N">TIDAK
											<?php
										}else{
											?>
												<input type="radio" name="aktif" value="Y">YA
												<input type="radio" name="aktif" value="N" checked>TIDAK
											<?php
										}
									?>
									
								</td>
							</tr>	
							<tr>
								<td></td>
								<td>
									<input type="button" class="tombol" value="kembali" onClick='window.location ="dashboard.php?mod=dpetugas"'><input type="submit" value="Simpan" class="tombol">					
								</td>				
							</tr>
						</form>
					</table>
				</div>
			<?php

		}else{
			header("Location: logout.php");
		}
	}

	else if($mod == "dintake"){
		?>
			<div class="box">
			<h2>Data Resident Intake</h2>
				
		<?php

		if($_SESSION[level] == "A"){

			$p = new Paging;
			$batas = 15;
			$posisi = $p->cariPosisi($batas);

			$bulan = date("F");
			$tahun = date("Y");
		
			$sql = mysql_query("select * from rehab where monthname(tgl_input)='$bulan' AND year(tgl_input)='$tahun' order by id_resident desc limit $posisi, $batas");
			
			$by = mysql_num_rows($sql);

			if($by > 0){
			?>
				<table id="table-3">
					<thead>
						<th>No</th><th>Nama</th><th>Alamat</th><th>No Telp</th><th>Pekerjaan</th><th>Drugs</th><th>Status</th><th>Print</th><th>Aksi</th>
					</thead>
					<tbody>

				<?php

					$no = $posisi+1;
					
					while ($d = mysql_fetch_array($sql)){
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><a href="dashboard.php?mod=biointake&id=<?php echo $d[id_resident]; ?>"  class="link"><?php echo $d[nama]; ?></a></td>
							<td><?php echo $d[alamat]; ?></td>
							<td><?php echo $d[no_telp]; ?></td>
							<td><?php echo $d[pekerjaan]; ?></td>
							<td>
								<?php
									$sf = mysql_fetch_array(mysql_query("select drugs from drugs where id_drugs = '$d[drugs_of_choice]'"));

									echo $sf[drugs];
								?>
							</td>
							<td>
								<?php 
									if($d[status] == "N"){
										echo "New Comer";
									}else{
										echo "Relapser";
									}
									
								?>
							</td>
							<td><a href="cetak.php?mod=resident&id=<?php echo $d[id_resident]; ?>"  target="_blank"><span class="icon14-print"></span></a></td>
							<td><a href="?mod=editintake&id=<?php echo $d[id_resident]; ?>" title="Edit"><span class="icon14-edit"></a></td>
						</tr>
					<?php
						
						$no++;
					}		
					
					?>	
					
					</tbody>
				</table>

				<?php
					$jmldata = mysql_num_rows(mysql_query("select * from rehab where monthname(tgl_input)='$bulan' AND year(tgl_input)='$tahun'"));
					$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
					$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
						
					if ($jmldata > $batas){
						echo "<div class='paging'>$linkHalaman</div>";
					}else{
						
					}
				
			}else {
				?>
					
						<fieldset class="warning">
							Belum ada data bulan ini
						</fieldset>	
					</div>	
				<?php
			}

		}else{
			
			$p = new Paging;
			$batas = 15;
			$posisi = $p->cariPosisi($batas);
		
			$sql = mysql_query("select * from rehab where petugas='$_SESSION[nama]'AND tgl_input=current_date() order by id_resident desc limit $posisi, $batas");
			
			$by = mysql_num_rows($sql);

			if($by > 0){
			?>
				<table id="table-3">
					<thead>
						<th>No</th><th>Nama</th><th>Alamat</th><th>No Telp</th><th>Pekerjaan</th><th>Drugs</th><th>Status</th><th>Print</th><th>Aksi</th>
					</thead>
					<tbody>

				<?php

					$no = $posisi+1;
					
					while ($d = mysql_fetch_array($sql)){
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><a href="dashboard.php?mod=biointake&id=<?php echo $d[id_resident]; ?>" class="link"><?php echo $d[nama]; ?></a></td>
							<td><?php echo $d[alamat]; ?></td>
							<td><?php echo $d[no_telp]; ?></td>
							<td><?php echo $d[pekerjaan]; ?></td>
							<td>
								<?php
									$sf = mysql_fetch_array(mysql_query("select drugs from drugs where id_drugs = '$d[drugs_of_choice]'"));

									echo $sf[drugs];
								?>
							</td>
							<td>
								<?php 
									if($d[status] == "N"){
										echo "New Comer";
									}else{
										echo "Relapser";
									}
									
								?>
							</td>
							<td><a href="cetak.php?mod=resident&id=<?php echo $d[id_resident]; ?>"  target="_blank"><span class="icon14-print"></span></a></td>
							<td><a href="?mod=editintake&id=<?php echo $d[id_resident]; ?>" title="Edit"><span class="icon14-edit"></a></td>
						</tr>
					<?php
						
						$no++;
					}		
					
					?>	
					
					</tbody>
				</table>

				<?php
					$jmldata = mysql_num_rows(mysql_query("select * from rehab  where petugas='$_SESSION[nama]' AND tgl_input=current_date()"));
					$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
					$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
						
					if ($jmldata > $batas){
						echo "<div class='paging'>$linkHalaman</div>";
					}else{
						
					}
				
			}else {
				?>
					
						<fieldset class="warning">
							Belum ada data hari ini
						</fieldset>	
					</div>	
				<?php
			}
		}
		
	}

	else if($mod == "biointake"){
		$sql = mysql_query("select * from rehab where id_resident = '$_GET[id]'");
		$e = mysql_fetch_array($sql);

		?>
			<div class="box">
				<h2>Resident Intake</h2>
				<table id="table-3">
						<tr>
							<td>Nama</td>
							<td>
								<?php echo $e[nama]; ?>					
							</td>				
						</tr>
						<tr>
							<td>Tempat Lahir</td>
							<td>
								<?php echo $e[tempat_lahir]; ?>					
							</td>				
						</tr>
						<tr>
							<td>Alamat</td>
							<td>
								<?php echo $e[alamat]; ?>				
							</td>				
						</tr>
						<tr>
							<td>No Telp</td>
							<td>
								<?php echo $e[no_telp]; ?>				
							</td>				
						</tr>
						<tr>
							<td>Pendidikan</td>
							<td>
								<?php 
									$a = mysql_fetch_array(mysql_query("select pendidikan from pendidikan where id_pendidikan = '$e[pendidikan]'"));
									echo $a[pendidikan]; 
								?>				
							</td>				
						</tr>
						<tr>
							<td>Anak Ke</td>
							<td>
								<?php echo $e[anak_ke]; ?>
								 Dari
								<?php echo $e[anak_dari]; ?> Bersaudara	
							</td>				
						</tr>
						<tr>
							<td>Pekerjaan</td>
							<td>
								<?php echo $e[pekerjaan]; ?>			
							</td>				
						</tr>
						<tr>
							<td>Agama</td>
							<td>
								<?php 
									$b = mysql_fetch_array(mysql_query("select agama from agama where id_agama = '$e[agama]'"));
									echo $b[agama]; 
								?>		
							</td>				
						</tr>
						<tr>
							<td>Suku</td>
							<td>
								<?php 
									if($e[suku] == NULL){
										echo "--";
									}else{
										echo $e[suku]; 
									}	
								?>				
							</td>				
						</tr>
						<tr>
							<td>Status Perkawinan</td>
							<td>
								<?php
									if($e[status_kawin] == "Kawin"){
										echo "Kawin";
									}else{
										echo "Belum Kawin";
									}
								?>
												
							</td>				
						</tr>
						<tr>
							<td>Nama Istri</td>
							<td>
								<?php 
									if($e[nama_istri] == NULL){
										echo "--";
									}else{
										echo $e[nama_istri]; 
									}	
								?>		
							</td>				
						</tr>
						<tr>
							<td>Nama Anak</td>
							<td>
								<?php 
									if($e[nama_anak] == NULL){
										echo "--";
									}else{
										echo $e[nama_anak]; 
									}	
								?>			
							</td>				
						</tr>
						<tr>
							<td>Nama Ayah</td>
							<td>
								<?php 
									if($e[nama_ayah] == NULL){
										echo "--";
									}else{
										echo $e[nama_ayah]; 
									}	
								?>						
							</td>				
						</tr>
						<tr>
							<td>Nama Ibu</td>
							<td>
								<?php 
									if($e[nama_ibu] == NULL){
										echo "--";
									}else{
										echo $e[nama_ibu]; 
									}	
								?>					
							</td>				
						</tr>
						<tr>
							<td>No Telp Ayah</td>
							<td>
								<?php 
									if($e[no_telp_ayah] == NULL){
										echo "--";
									}else{
										echo $e[no_telp_ayah]; 
									}	
								?>					
							</td>				
						</tr>
						<tr>
							<td>No Telp Ibu</td>
							<td>
								<?php 
									if($e[no_telp_ibu] == NULL){
										echo "--";
									}else{
										echo $e[no_telp_ibu]; 
									}	
								?>				
							</td>				
						</tr>
						<tr>
							<td>Alamat Ayah</td>
							<td>
								<?php 
									if($e[alamat_ayah] == NULL){
										echo "--";
									}else{
										echo $e[alamat_ayah]; 
									}	
								?>	
							</td>				
						</tr>
						<tr>
							<td>Alamat Ibu</td>
							<td>
								<?php 
									if($e[alamat_ibu] == NULL){
										echo "--";
									}else{
										echo $e[alamat_ibu]; 
									}	
								?>		
							</td>				
						</tr>
						<tr>
							<td>Pertama Kali Pakai</td>
							<td>
								<?php echo $e[tahun_pakai]; ?>					
							</td>				
						</tr>
						<tr>
							<td>Drugs of Choice</td>
							<td>
								<?php 
									$c = mysql_fetch_array(mysql_query("select drugs from drugs where id_drugs = '$e[drugs_of_choice]'"));
									echo $c[drugs]; 
								?>						
							</td>				
						</tr>
						<tr>
							<td>Rehab Sebelumnya</td>
							<td>
								<?php 
									if($e[rehab_sebelumnya] == NULL){
										echo "--";
									}else{
										echo $e[rehab_sebelumnya]; 
									}	
								?>					
							</td>				
						</tr>
						<tr>
							<td>Penyakit Bawaan</td>
							<td>
								<?php 
									if($e[penyakit_bawaan] == NULL){
										echo "--";
									}else{
										echo $e[penyakit_bawaan]; 
									}	
								?>				
							</td>				
						</tr>
						<tr>
							<td>Pernah Kecelakaan</td>
							<td>
								<?php
									if($e[pernah_kecelakaan] == "Ya"){
										echo "Ya";
									}else{
										echo "Tidak";
									}
								?>
													
							</td>				
						</tr>
						<tr>
							<td>HIV / HCV</td>
							<td>
								<?php 
									if($e[hiv] == NULL){
										echo "--";
									}else{
										echo $e[hiv]; 
									}	
								?>				
							</td>				
						</tr>
						<tr>
							<td>Golongan Darah</td>
							<td>
								<?php 
									$d = mysql_fetch_array(mysql_query("select darah from darah where id_darah = '$e[gol_darah]'"));
									echo $d[darah]; 
								?>						
							</td>				
						</tr>
						<tr>
							<td>Berat Badan</td>
							<td>
								<?php 
									if($e[berat_badan] == NULL){
										echo "--";
									}else{
										echo $e[berat_badan]; 
									}	
								?>				
							</td>				
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<?php
									if($e[status] == "N"){
										echo "New Comer";
									}else{
										echo "Relapser";
									}
								?>
								
							</td>				
						</tr>
						<tr>
							<td>
								<input type="button" class="tombol" value="kembali" onClick='window.location ="dashboard.php?mod=dintake"'>
							</td>
							<td></td>				
						</tr>
					</form>
				</table>
			</div>	
		<?php
	}

	else if($mod == "dpetugas"){
		?>
			<div class="box">
			<h2>Data Petugas</h2>
				
		<?php

		if($_SESSION[level] == "A"){

			$p = new Paging;
			$batas = 15;
			$posisi = $p->cariPosisi($batas);
		
			$sql = mysql_query("select * from petugas where nip != '000000' order by nama desc limit $posisi, $batas");
			
			$by = mysql_num_rows($sql);

			if($by > 0){
			?>
				<table id="table-3">
					<thead>
						<th>No</th><th>Nama</th><th>NIP</th><th>Level</th><th>Aktif</th><th>Aksi</th>
					</thead>
					<tbody>

				<?php

					$no = $posisi+1;
					
					while ($d = mysql_fetch_array($sql)){
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $d[nama]; ?></td>
							<td><?php echo $d[nip]; ?></td>
							<td>
								<?php
									if($d[level] == "A") {
										echo "Admin";
									}else{
										echo "Petugas";
									}
								?>
							</td>
							<td>
								<?php 
									if($d[aktif] == "Y") {
										echo "Ya";
									}else{
										echo "Tidak";
									}
								?>
							</td>
							<td><a href="?mod=editpetugas&id=<?php echo $d[nip]; ?>" title="Edit"><span class="icon14-edit"></a></td>
						</tr>
					<?php
						
						$no++;
					}		
					
					?>	
					
					</tbody>
				</table>

				<?php
					$jmldata = mysql_num_rows(mysql_query("select * from petugas where nip != '000000'"));
					$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
					$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
						
					if ($jmldata > $batas){
						echo "<div class='paging'>$linkHalaman</div>";
					}else{
						
					}
				
			}else {
				?>
					
						<fieldset class="warning">
							Tidak Ada Data
						</fieldset>	
					</div>	
				<?php
			}

		}else{
			header("Location: logout.php");
		}
	}



	else if($mod == "dpimpinan"){
		$sql = mysql_query("select * from pimpinan where id_pimpinan = '1'");
		$e = mysql_fetch_array($sql);

		?>
			<div class="box">
				<h2>Data Pimpinan</h2>
				<table class="table-form">
					<tr>
						<td>Nama</td><td><b>:</b> <?php echo $e[nama]; ?></td>
					</tr>
					<tr>
						<td>NIP</td><td><b>:</b> <?php echo $e[nip]; ?></td>
					</tr>
					<tr>
						<td>Jabatan</td><td><b>:</b> <?php echo $e[jabatan]; ?></td>
					</tr>

				</table>
			</div>
		<?php
	}

	else if($mod == "lintake"){
			?>
				<div class="box">
					<h2>Rekap Resident Intake</h2>
					<form action="?mod=rekap" method="post">
						<table class="tengah">
							<tr>
								<td>
									<select name="tahun" required class="txt2">
										<option value="" selected>Tahun</option>

									<?php
										$sql1 = mysql_query("select min(year(tgl_input)) as tahun from rehab");
										$sql2 = mysql_query("select max(year(tgl_input)) as tahun from rehab");
										$d1 = mysql_fetch_array($sql1);
										$d2 = mysql_fetch_array($sql2);

										for($d1[tahun]; $d1[tahun] <= $d2[tahun]; $d1[tahun]++ ){
											echo "<option value='$d1[tahun]' >$d1[tahun]</option>";
										}
									?>	
									</select>
								</td>
								<td>
									<select name="bulan" required class="txt2">
										<option value="" selected>Bulan</option>
										<option value="january">Januari</option>
										<option value="february">Februari</option>
										<option value="march" >Maret</option>
										<option value="april">April</option>
										<option value="may">Mei</option>
										<option value="june">Juni</option>
										<option value="july">Juli</option>
										<option value="august">Agustus</option>
										<option value="september">September</option>
										<option value="october">Oktober</option>
										<option value="november">November</option>
										<option value="december">Desember</option>
									</select>
								</td>
								<td>
									<input type="submit" value="rekap" class="tombol">
								</td>
							</tr>
						</table>
					</form>
				</div>
			<?php
	}

	else if($mod == "rekap"){
		?>
			<div class="box">
				<h2>Hasil Rekap</h2>
				<?php

					$p = new Paging;
					$batas = 15;
					$posisi = $p->cariPosisi($batas);
				
					$sql = mysql_query("select * from rehab where monthname(tgl_input) = '$_POST[bulan]' AND year(tgl_input) = '$_POST[tahun]' limit $posisi, $batas");
					
					$by = mysql_num_rows($sql);

					if($by > 0){
					?>
						<fieldset class="warning">
							<table>
								<tr>
									<td>Bulan</td><td>:</td><td><b><?php echo $_POST[bulan]; ?></b></td>
								</tr>
								<tr>
									<td>Tahun</td><td>:</td><td><b><?php echo $_POST[tahun]; ?></b></td>
								</tr>
								<tr>
									<td>Jumlah Data</td><td>:</td><td><b><?php echo "$by orang"; ?></b></td>
								</tr>
								<tr>
									<td>Cetak</td><td>:</td><td><a href="cetak.php?mod=rekap&bulan=<?php echo $_POST[bulan]; ?>&tahun=<?php echo $_POST[tahun]; ?>" target="_blank"><span class="icon-pdf"></span></a></td>
								</tr>
							</table>
						</fieldset>
						<table id="table-3">
							<thead>
								<th>No</th><th>Nama</th><th>Alamat</th><th>No Telp</th><th>Pekerjaan</th><th>Drugs</th><th>Status</th><th>Print</th><th>Aksi</th>
							</thead>
							<tbody>

						<?php

							$no = $posisi+1;
							
							while ($d = mysql_fetch_array($sql)){
							?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><a href="dashboard.php?mod=biointake&id=<?php echo $d[id_resident]; ?>" class="link"><?php echo $d[nama]; ?></a></td>
									<td><?php echo $d[alamat]; ?></td>
									<td><?php echo $d[no_telp]; ?></td>
									<td><?php echo $d[pekerjaan]; ?></td>
									<td>
										<?php
											$sf = mysql_fetch_array(mysql_query("select drugs from drugs where id_drugs = '$d[drugs_of_choice]'"));

											echo $sf[drugs];
										?>
									</td>
									<td>
										<?php 
											if($d[status] == "N"){
												echo "New Comer";
											}else{
												echo "Relapser";
											}
											
										?>
									</td>
									<td><a href="cetak.php?mod=resident&id=<?php echo $d[id_resident]; ?>" target="_blank"><span class="icon14-print"></span></a></td>
									<td><a href="?mod=editintake&id=<?php echo $d[id_resident]; ?>" title="Edit"><span class="icon14-edit"></a></td>
								</tr>
							<?php
								
								$no++;
							}		
							
							?>	
							
							</tbody>
						</table>
						
						<button onClick='window.location ="dashboard.php?mod=lintake"' class="tombol">Kembali</button>	
								
						<?php
							$jmldata = mysql_num_rows(mysql_query("select * from rehab where monthname(tgl_input) = '$_POST[bulan]' AND year(tgl_input) = '$_POST[tahun]'"));
							$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
							$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
								
							if ($jmldata > $batas){
								echo "<div class='paging'>$linkHalaman</div>";
								
							}else{
								
							}
						
					}else {
						?>
							<fieldset class="warning">
								Rekap data tidak ada
							</fieldset>
							<button onClick='window.location ="dashboard.php?mod=lintake"' class="tombol">Kembali</button>	
						<?php
					}
				?>
			</div>
		<?php
	}
	
	else if($mod == "cari"){
		?>
			<div class="box">
				<table class="tengah">
					<form action="?mod=hasil" method="post">
						<tr>
							<td>
								<input type="text" name="cari" class="txt" style="width:500px; height:35px;" placeholder="Tuliskan nama pecandu yang Anda cari" required><input type="submit" value="Cari" class="tombol" style="padding : 10px;">						
							</td>				
						</tr>
					</form>
				</table>
			</div>	
		<?php
	}

	else if($mod == "hasil"){
		?>
			<div class="box">
				<h2>Hasil Pencarian</h2>
				<?php

					$p = new Paging;
					$batas = 15;
					$posisi = $p->cariPosisi($batas);
				
					$sql = mysql_query("select * from rehab where nama like '%$_POST[cari]%' limit $posisi, $batas");
					
					$by = mysql_num_rows($sql);

					if($by > 0){
					?>
						<fieldset class="warning">
							<table>
								<tr>
									<td>Kata Kunci yang di cari</td><td>:</td><td><b><?php echo $_POST[cari]; ?></b></td>
								</tr>
								<tr>
									<td>Hasil yang di temukan</td><td>:</td><td><b><?php echo $by; ?></b></td>
								</tr>
							</table>
						</fieldset>
						<table id="table-3">
							<thead>
								<th>No</th><th>Nama</th><th>Alamat</th><th>No Telp</th><th>Pekerjaan</th><th>Drugs</th><th>Status</th><th>Print</th><th>Aksi</th>
							</thead>
							<tbody>

						<?php

							$no = $posisi+1;
							
							while ($d = mysql_fetch_array($sql)){
							?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><a href="dashboard.php?mod=biointake&id=<?php echo $d[id_resident]; ?>" class="link"><?php echo $d[nama]; ?></a></td>
									<td><?php echo $d[alamat]; ?></td>
									<td><?php echo $d[no_telp]; ?></td>
									<td><?php echo $d[pekerjaan]; ?></td>
									<td>
										<?php
											$sf = mysql_fetch_array(mysql_query("select drugs from drugs where id_drugs = '$d[drugs_of_choice]'"));

											echo $sf[drugs];
										?>
									</td>
									<td>
										<?php 
											if($d[status] == "N"){
												echo "New Comer";
											}else{
												echo "Relapser";
											}
											
										?>
									</td>
									<td><a href="cetak.php?mod=resident&id=<?php echo $d[id_resident]; ?>" target="_blank"><span class="icon14-print"></span></a></td>
									<td><a href="?mod=editintake&id=<?php echo $d[id_resident]; ?>" title="Edit"><span class="icon14-edit"></a></td>
								</tr>
							<?php
								
								$no++;
							}		
							
							?>	
							
							</tbody>
						</table>
						
						<button onClick='window.location ="dashboard.php?mod=cari"' class="tombol">Kembali</button>	
								
						<?php
							$jmldata = mysql_num_rows(mysql_query("select * from rehab where nama like '%$_POST[cari]%'"));
							$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
							$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
								
							if ($jmldata > $batas){
								echo "<div class='paging'>$linkHalaman</div>";
								
							}else{
								
							}
						
					}else {
						?>
							<fieldset class="warning">
								Data yang Anda Cari tidak ditemukan
							</fieldset>
							<button onClick='window.location ="dashboard.php?mod=cari"' class="tombol">Kembali</button>	
						<?php
					}
				?>
			</div>
		<?php
	}

	else if($mod == "gpass"){
		?>	
			<div class="box">
				<h2>Ganti Password</h2>
				<?php
					if($_GET[notice] == "warning"){
						?>
							<fieldset class="warning">Kata Sandi Lama Anda Tidak sesuai dengan data Di Database. Coba Ulangi Lagi</fieldset>
						<?php
					}

					if($_GET[notice] == "error"){
						?>
							<fieldset class="error">Kata Sandi Baru Anda Tidak Cocok dengan Konfirmasi Kata Sandi Baru. Coba Ulangi Lagi</fieldset>
						<?php
					}

					if($_GET[notice] == "ok"){
						?>
							<fieldset class="ok">Kata Sandi Anda berhasil diganti</fieldset>
						<?php
					}
				?>
				<table class="table-form">
				<form action="act.php?mod=gpass&act=ubah" method="post">
					<tr>
						<td>Password Lama</td>
						<td>
							<input type="password" name="plama" placeholder="Tuliskan password lama Anda" class="txt" style="width : 450px;" required>
						</td>
					</tr>
					<tr>
						<td>Password Baru</td>
						<td>
							<input type="password" name="pbaru" placeholder="Tuliskan password baru Anda" class="txt" style="width : 450px;" required>
						</td>
					</tr>
					<tr>
						<td>Konfirmasi Password Baru</td>
						<td>
							<input type="password" name="kpbaru" placeholder="Tuliskan konfirmasi password baru Anda" class="txt" style="width : 450px;" required>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="button" value="kembali" class="tombol" onClick='window.location ="dashboard.php?mod=home"'><input type="submit" value="Ubah" class="tombol">
						</td>
					</tr>
				</form>
				</table>
			</div>
		<?php
	}

	else if($mod == "rpass"){
		if($_SESSION[level] == "A"){
			?>
				<div class="box">
					<h2>Reset Password Petugas</h2>
					<?php
						if($_GET[notice] == "ok"){
							?>
								<fieldset class="ok">
									Password berhasil direset ke default
								</fieldset>
							<?php
						}

						if($_GET[notice] == "error"){
							?>
								<fieldset class="error">
									Password gagal di reset, mohon periksa lagi nip yang di isi
								</fieldset>
							<?php
						}

						if($_GET[notice] == "warning"){
							?>
								<fieldset class="warning">
									NIP yang Anda input tidak terdata disistem, coba periksa lagi NIP yang Anda input
								</fieldset>
							<?php
						}

					?>
					<table class="table-form">
						<form action="act.php?mod=rpass&act=reset" method="post">
							<tr>
								<td>NIP</td>
								<td>
									<input type="text" name="nip" placeholder="Tuliskan NIP petugas harian yang di reset password" class="txt" style="width: 450px;" required>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="button" class="tombol2" value="kembali" onClick='window.location ="dashboard.php?mod=home"'> <input type="submit" value="Reset password" class="tombol2">	
								</td>
							</tr>
						</form>
					</table>
				</div>
			<?php
		}else{
			header("Location: logout.php");
		}
	}
	else{
		?>
			<div class="box">
				<fieldset class="warning">
					Modul Belum terinstall
				</fieldset>
			</div>
		<?php
	}




?>