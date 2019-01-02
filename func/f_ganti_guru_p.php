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
$reference = $database->getReference('TARQ/KELAS/PRIVATE/'.$_SESSION['akses'].'/'.$id);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();


if (isset($value['jadwallama'])) {
  $jadwallama = $value['jadwallama'];
}else{
  $jadwallama = '0';
}

if (isset($_POST['guru'])) {
  $guru = $_POST['guru'];
  $refguru = $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses'].'/'.$guru);
  $snapguru = $refguru->getSnapshot();
  $valguru = $snapguru->getValue();

  $namaguru = $valguru['nama'];
  if (isset($_SESSION['akses'])){

    // set guru baru
    $refrerence = "TARQ/KELAS/PRIVATE/".$_SESSION['akses']."/".$id;
    $newpost = $database
      ->getReference($refrerence)
      ->set([
          'nokelas'           =>$id,
          'guru'              =>$namaguru,
          'idguru'            =>$guru,
          'idmurid'           =>$value['idmurid'],
          'murid'             =>$value['murid'],
          'jadwallama'        =>$jadwallama,
          'jadwalhari'        =>$value['jadwalhari'],
          'jmlpertemuan'      =>$value['jmlpertemuan'],
          'lokasilang'        =>$value['lokasilang'],
          'lokasilat'         =>$value['lokasilat'],
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