<?php
// session_start();

if (empty($_SESSION['nip']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<script>alert('Kembalilah Kejalan yg benar!!!'); window.location = 'index.php';</script>";
}
    else{
?>

<?php
// Bagian home
if ($_GET['module']=='home'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_home/home_v.php";
  }
}

elseif ($_GET['module']=='siswa'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_siswa/siswa_v.php";
  }
}

elseif ($_GET['module']=='group_soal'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_group_soal/group_soal_v.php";
  }
}

elseif ($_GET['module']=='soal'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_soal/soal_v.php";
  }
}

elseif ($_GET['module']=='formula'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_formula/formula_v.php";
  }
}

elseif ($_GET['module']=='jadwal'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_jadwal/jadwal_v.php";
  }
}

elseif ($_GET['module']=='jadwalujian'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_jadwalujian/jadwalujian_v.php";
  }
}

elseif ($_GET['module']=='nilai'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_nilai/nilai_v.php";
  }
}

elseif ($_GET['module']=='profil'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_profil/profil_v.php";
  }
}

elseif ($_GET['module']=='belum'){
  if ($_SESSION['level']=='guru'){
    include "modul/mod_belum/belum_v.php";
  }
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b><center>MODUL BELUM ADA ATAU BELUM LENGKAP</center></b></p>";
}
}
?>
