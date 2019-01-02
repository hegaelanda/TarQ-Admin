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

$uid     = $_GET['id'];
$reference = $database->getReference('TARQ/USER/JAMAAH/'.$_SESSION['akses'].'/'.$uid);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
$lat = $value['latitude'];
$long = $value['longitude'];
$saldo = $value['saldo'];

$auth = $firebase->getAuth();

if (isset($_POST['email'])) {
  $email   = $_POST['email'];
  $nama    = $_POST['nama'];
  $nohp    = $_POST['nohp'];
  $nonik    = $_POST['nonik'];
  $tanggallahir = $_POST['tanggallahir'];
  $newDate = date("d/m/Y", strtotime($tanggallahir));
  $alamat = $_POST['alamat'];
 
if (isset($_SESSION['akses'])){

    //set guru baru
    $refrerence = "TARQ/USER/JAMAAH/".$_SESSION['akses']."/".$uid;
    $newpost = $database
      ->getReference($refrerence)
      ->set([
          'id_user'       =>$uid,
          'nama'          =>strtoupper($nama),
          'nohp'          =>$nohp,
          'tanggallahir'  =>$newDate,
          'alamat'        =>strtoupper($alamat),
          'latitude'      =>$lat,
          'longitude'     =>$long,
          'saldo'         =>$saldo,
          'noNIK'         =>$nonik,
          'level'         =>2
      ]);

    if ($newpost) {
      echo '<script type="text/javascript">';
      echo "alert('User ID : $uid and Email :$email Updated!');";
      echo 'window.location.href = "../pages/v_jamaah.php";';
      echo '</script>';
    }else{
      echo '<script type="text/javascript">alert("Data gagal ditambahkan"); window.history.back() = "../pages/v_guru.php"</script>';
    }
  }else{
    echo '<script type="text/javascript">alert("Kesalahan, Coba Login Ulang");</script>';
  }
}
?>