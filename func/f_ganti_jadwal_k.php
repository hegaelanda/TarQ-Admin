<?php
session_start();
include '../database/database_lembaga.php';
require '../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('../database/lkptarq93-firebase-adminsdk-hrybb-331d42bc6b.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://lkptarq93.firebaseio.com')
    ->create();

$database = $firebase->getDatabase();

$id     = $_GET['id'];
$reference = $database->getReference('TARQ/KELAS/KANTOR/'.$_SESSION['akses'].'/'.$id);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();

if (isset($_POST['jadwalbaru'])) {
  $waktu = $_POST['waktu'];
  $jadwalbaru   = $_POST['jadwalbaru'];
  $newjadwalbaru = $jadwalbaru.' '.$waktu.':00';
  date_default_timezone_set('Asia/Jakarta');
  $epochjadwalbaru = strtotime($newjadwalbaru);
  $pertemuanke    = $_POST['pertemuanke'];
  $jadwallama = $value['jadwalhari'];

  $base = explode("000,", $jadwallama);
  $replacement = array($pertemuanke => $epochjadwalbaru);

  $basket = array_replace($base, $replacement);
  $hasil = implode("000,", $basket);
  
  if (isset($_SESSION['akses'])){

    // set guru baru
    $refrerence = "TARQ/KELAS/KANTOR/".$_SESSION['akses']."/".$id;
    $newpost = $database
      ->getReference($refrerence)
      ->set([
          'nokelas'       =>$id,
          'guru'          =>$value['guru'],
          'idguru'          =>$value['idguru'],
          'idmurid'          =>$value['idmurid'],
          'murid'          =>$value['murid'],
          'jadwallama'    =>$jadwallama,
          'jadwalhari'          =>$hasil,
          'jmlpertemuan'          =>$value['jmlpertemuan'],
          'lokasilang'          =>$value['lokasilang'],
          'lokasilat'          =>$value['lokasilat'],
          'pelajaran'         =>$value['pelajaran']
      ]);

    if ($newpost) {
      echo "<script>alert('Success');window.location.href='../pages/v_monitor_jadwal_p.php';</script>";
    }else{
      echo '<script type="text/javascript">alert("Data gagal ditambahkan"); window.history.back() = "../pages/v_guru.php"</script>';
    }
  }else{
    echo '<script type="text/javascript">alert("Kesalahan, Coba Login Ulang");</script>';
  }
}
?>