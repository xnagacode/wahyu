<?php
function UploadFile($fupload_name){
  //direktori file
  $vdir_upload = "../file/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["surat"]["tmp_name"], $vfile_upload);
}

?>
