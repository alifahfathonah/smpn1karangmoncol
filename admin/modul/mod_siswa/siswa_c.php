    <?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<script>alert('Kembalilah Kejalan yg benar!!!'); window.location = 'index.php';</script>";
}
else{
include "../../../system/koneksi.php";
include "../../../system/fungsi_upload.php";

$module	= $_GET['module'];
$act	= $_GET['act'];


if($act=='update')
{
    
    if ($module=='siswa' AND $act=='update')
    {   

    if (!is_numeric($_POST['nis'])) {
    echo "<script>alert('Maaf! NIS Harus Angka.'); window.location = '../../media.php?module=$module';</script>";
    die();
  }
    if (!is_numeric($_POST['no_telp'])) {
    echo "<script>alert('Maaf! Nomor Telpon Harus Angka.'); window.location = '../../media.php?module=$module';</script>";
    die();
  }

        $nama_file    = $_FILES['fupload']['name'];
        //jika Password dan foto tidak dirubah
        if (empty($_POST['password']) AND empty($nama_file)) {
        
        mysql_query("UPDATE student SET
                                  nis            = '$_POST[nis]',
                                  name           = '$_POST[nama]',
                                  class_id       = '$_POST[kelas]',
                                  address        = '$_POST[alamat]',
                                  po_birth       = '$_POST[tempat_lahir]',
                                  do_birth       = '$_POST[tgl_lahir]',
                                  gender         = '$_POST[jk]',
                                  religion       = '$_POST[agama]',
                                  father_name    = '$_POST[nama_ayah]',
                                  mother_name    = '$_POST[nama_ibu]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]'
                           WHERE  nis     = '$_POST[id]'"); 

          echo "<script>alert('Sukses! Data berhasil di Update'); window.location = '../../media.php?module=$module';</script>"; 
          //Jika password di rubah dan foto tidak dirubah
        }elseif (!empty($_POST['password']) AND empty($nama_file)) {
            $pass = md5($_POST['password']);
            mysql_query("UPDATE student SET
                                  nis            = '$_POST[nis]',
                                  name           = '$_POST[nama]',
                                  password       = '$pass',
                                  class_id       = '$_POST[kelas]',
                                  address        = '$_POST[alamat]',
                                  po_birth       = '$_POST[tempat_lahir]',
                                  do_birth       = '$_POST[tgl_lahir]',
                                  gender         = '$_POST[jk]',
                                  religion       = '$_POST[agama]',
                                  father_name    = '$_POST[nama_ayah]',
                                  mother_name    = '$_POST[nama_ibu]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]'
                           WHERE  nis     = '$_POST[id]'");
          echo "<script>alert('Sukses! Data berhasil di Update'); window.location = '../../media.php?module=$module';</script>";
        //jika password dirubah dan foto dirubah  
        }elseif (!empty($_POST['password']) AND !empty($nama_file)) {
            $lokasi_file    = $_FILES['fupload']['tmp_name'];
                  $tipe_file      = $_FILES['fupload']['type'];
                  $nama_file      = $_FILES['fupload']['name'];

                  $acak           = rand(000,999);
                  $nama_gambar = $acak.'-'.$nama_file; 

            if(!empty($lokasi_file))
                {
                
                  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                    echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                    die();
                  }
                  
                  $show = mysql_query("SELECT * FROM student WHERE nis='$_POST[id]'");
                  $row  = mysql_fetch_assoc($show);
                  if($row['picture'] != '')
                  {
                    unlink("../../../image/siswa/$row[picture]");
                  }

                  ImageUpload($fupload_name=$nama_gambar, $to_dir='../../../image/siswa/');

                  $pass = md5($_POST['password']);
                  mysql_query("UPDATE student SET
                                  nis            = '$_POST[nis]',
                                  name           = '$_POST[nama]',
                                  password       = '$pass',
                                  class_id       = '$_POST[kelas]',
                                  address        = '$_POST[alamat]',
                                  po_birth       = '$_POST[tempat_lahir]',
                                  do_birth       = '$_POST[tgl_lahir]',
                                  gender         = '$_POST[jk]',
                                  religion       = '$_POST[agama]',
                                  father_name    = '$_POST[nama_ayah]',
                                  mother_name    = '$_POST[nama_ibu]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  picture        = '$nama_gambar'
                           WHERE  nis     = '$_POST[id]'");
                echo "<script>alert('Sukses! Data berhasil di Update'); window.location = '../../media.php?module=$module';</script>";
            }else{
              echo "<script>alert('Maaf! Data Gagal di Update, silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
            }
        //jika password tidak dirubah dan foto dirubah  
        }elseif (empty($_POST['password']) AND !empty($nama_file)) {
          $lokasi_file    = $_FILES['fupload']['tmp_name'];
                  $tipe_file      = $_FILES['fupload']['type'];
                  $nama_file      = $_FILES['fupload']['name'];

                  $acak           = rand(000,999);
                  $nama_gambar = $acak.'-'.$nama_file; 

            if(!empty($lokasi_file))
                {
                
                  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                    echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                    die();
                  }
                  
                  $show = mysql_query("SELECT * FROM student WHERE nis='$_POST[id]'");
                  $row  = mysql_fetch_assoc($show);
                  if($row['foto'] != '')
                  {
                    unlink("../../../image/siswa/$row[picture]");
                  }

                  ImageUpload($fupload_name=$nama_gambar, $to_dir='../../../image/siswa/');

                 
                  mysql_query("UPDATE student SET
                                  nis            = '$_POST[nis]',
                                  name           = '$_POST[nama]',
                                  class_id       = '$_POST[kelas]',
                                  address        = '$_POST[alamat]',
                                  po_birth       = '$_POST[tempat_lahir]',
                                  do_birth       = '$_POST[tgl_lahir]',
                                  gender         = '$_POST[jk]',
                                  religion       = '$_POST[agama]',
                                  father_name    = '$_POST[nama_ayah]',
                                  mother_name    = '$_POST[nama_ibu]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  picture        = '$nama_gambar'
                           WHERE  nis     = '$_POST[id]'");
                echo "<script>alert('Sukses! Data berhasil di Update'); window.location = '../../media.php?module=$module';</script>";
            }else{
              echo "<script>alert('Maaf! Data Gagal di Update, silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
            }
        }

       
}
else{
    echo "<script>alert('Maaf! Data Gagal di Update, silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
}

}

elseif($act=='blokir')
{
    // Insert
    if ($module=='siswa' AND $act=='blokir')
    {
        
            mysql_query("UPDATE student SET block = 'Y'
                           WHERE nis      = '$_POST[id]'");
            
            $sql = mysql_query("SELECT * FROM student WHERE nis = '$_POST[id]' ");
            $cek = mysql_fetch_assoc($sql);

    echo "<script>alert('Sukses! Data Siswa ".$cek['name']." telah Terblokir.'); window.location = '../../media.php?module=$module';</script>";
}
else{
    echo "<script>alert('Maaf! Data Gagal di Blokir, silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
}

}


elseif($act=='aktif')
{
  
      if ($module=='siswa' AND $act=='aktif')
    {
        
            mysql_query("UPDATE student SET block = 'N'
                           WHERE nis      = '$_GET[id]'");

    $sql = mysql_query("SELECT * FROM student WHERE nis = '$_GET[id]' ");
    $cek = mysql_fetch_assoc($sql);

    echo "<script>alert('Sukses! Data Siswa ".$cek['name']." telah Aktif kembali.'); window.location = '../../media.php?module=$module';</script>";
}
else{
    echo "<script>alert('Maaf! Data Gagal di Aktifkan, silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
}

}

elseif ($act=='insert') {
    if ($module=='siswa' AND $act=='insert') {

    if (!is_numeric($_POST['nis'])) {
    echo "<script>alert('Maaf! NIS Harus Angka.'); window.location = '../../media.php?module=$module';</script>";
    die();
  }
    if (!is_numeric($_POST['no_telp'])) {
    echo "<script>alert('Maaf! Nomor Telpon Harus Angka.'); window.location = '../../media.php?module=$module';</script>";
    die();
  }
        
        $sql = mysql_query("SELECT * FROM student WHERE nis = '$_POST[nis]'");
        $cek = mysql_fetch_assoc($sql);
    if ($cek == 0) {
    
    $lokasi_file  = $_FILES['fupload']['tmp_name'];
    $tipe_file    = $_FILES['fupload']['type'];
    $nama_file    = $_FILES['fupload']['name'];

      $acak           = rand(000,999);
      $nama_gambar = $acak.'-'.$nama_file; 
    
    if(!empty($lokasi_file))
    {
    
      if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
        echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan Foto yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
        die();
      }
      
      ImageUpload($fupload_name=$nama_gambar, $to_dir='../../../image/siswa/');
      
        //data yang akan di insert
                        $tgl_lahir = $_POST['tgl_lahir'];
                        $pass = md5($_POST['password']);

                        mysql_query("INSERT INTO student(nis,
                                 name,
                                 password,
                                 class_id,
                                 address,
                                 po_birth,
                                 do_birth,
                                 gender,
                                 religion,
                                 father_name,
                                 mother_name,
                                 no_telp,
                                 email,
                                 picture)
                         VALUES('$_POST[nis]',
                                '$_POST[nama]',
                                '$pass',
                                '$_POST[kelas]',
                                '$_POST[alamat]',
                                '$_POST[tempat_lahir]',
                                '$tgl_lahir',
                                '$_POST[jk]',
                                '$_POST[agama]',
                                '$_POST[nama_ayah]',
                                '$_POST[nama_ibu]',
                                '$_POST[no_telp]',
                                '$_POST[email]',
                                '$nama_gambar')");
                        echo "<script>alert('Sukses! Data berhasil disimpan.'); window.location = '../../media.php?module=$module';</script>";

    }
    else
    {
                $tgl_lahir = $_POST['tgl_lahir'];
                        $pass = md5($_POST['password']);

                        mysql_query("INSERT INTO student(nis,
                                 name,
                                 password,
                                 class_id,
                                 alamat,
                                 tempat_lahir,
                                 tgl_lahir,
                                 gender,
                                 religion,
                                 nama_ayah,
                                 nama_ibu,
                                 no_telp,
                                 email,
                                 picture)
                         VALUES('$_POST[nis]',
                                '$_POST[nama]',
                                '$pass',
                                '$_POST[kelas]',
                                '$_POST[alamat]',
                                '$_POST[tempat_lahir]',
                                '$tgl_lahir',
                                '$_POST[jk]',
                                '$_POST[agama]',
                                '$_POST[nama_ayah]',
                                '$_POST[nama_ibu]',
                                '$_POST[no_telp]',
                                '$_POST[email]')");

    echo "<script>alert('Sukses! Data berhasil disimpan.'); window.location = '../../media.php?module=$module';</script>";    }

    }else{
        echo "<script>alert('Maaf! NIS udah ada dengan Nama ".$cek['name']." Mohon di cek kembali'); window.location = '../../media.php?module=$module';</script>";
    }

    }
}else{
  echo "<script>alert('Maaf! Data Gagal di Simpan, silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
}

}
?>
