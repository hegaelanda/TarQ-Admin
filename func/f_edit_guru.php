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
$reference = $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses'].'/'.$uid);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
$lat = $value['latitude'];
$long = $value['longitude'];
$latitudeRumah = $value['latitudeRumah'];
$longitudeRumah = $value['longitudeRumah'];
$saldo = $value['saldo'];

$auth = $firebase->getAuth();

if (isset($_POST['email'])) {
  $email   = $_POST['email'];
  $nama    = $_POST['nama'];
  $nohp    = $_POST['nohp'];
  $lembaga = $_GET['l'];
  $tanggallahir = $_POST['tanggallahir'];
  $newDate = date("d/m/Y", strtotime($tanggallahir));
  $alamat = $_POST['alamat'];
  if (isset($_POST['PraTahsin1'])) {
    $PraTahsin1 = "true";
  }else{
    $PraTahsin1 = "false";
  }
  if (isset($_POST['PraTahsin2'])) {
    $PraTahsin2 = "true";
  }else{
    $PraTahsin2 = "false";
  }
  if (isset($_POST['PraTahsin3'])) {
    $PraTahsin3 = "true";
  }else{
    $PraTahsin3 = "false";
  }
  if (isset($_POST['Tahsin1'])) {
    $Tahsin1 = "true";
  }else{
    $Tahsin1 = "false";
  }
  if (isset($_POST['Tahsin2'])) {
    $Tahsin2 = "true";
  }else{
    $Tahsin2 = "false";
  }
  if (isset($_POST['Tahsin3'])) {
    $Tahsin3 = "true";
  }else{
    $Tahsin3 = "false";
  }
  if (isset($_POST['Tahsin4'])) {
    $Tahsin4 = "true";
  }else{
    $Tahsin4 = "false";
  }
  if (isset($_POST['Tahfizh'])) {
    $Tahfizh = "true";
  }else{
    $Tahfizh = "false";
  }
  if (isset($_POST['BahasaArab'])) {
    $BahasaArab = "true";
  }else{
    $BahasaArab = "false";
  }
if (isset($_SESSION['akses'])){

    //set guru baru
    $refrerence = "TARQ/USER/GURU/".$_SESSION['akses']."/".$uid;
    $newpost = $database
      ->getReference($refrerence)
      ->set([
          'id_user'       =>$uid,
          'nama'          =>strtoupper($nama),
          'nohp'          =>$nohp,
          'tanggallahir'  =>$newDate,
          'alamat'        =>strtoupper($alamat),
          'lembaga'       =>strtoupper($lembaga),
          'pratahsin1'    =>$PraTahsin1,
          'pratahsin2'    =>$PraTahsin2,
          'pratahsin3'    =>$PraTahsin3,
          'tahsin1'       =>$Tahsin1,
          'tahsin2'       =>$Tahsin2,
          'tahsin3'       =>$Tahsin3,
          'tahsin4'       =>$Tahsin4,
          'tahfizh'       =>$Tahfizh,
          'bahasaarab'    =>$BahasaArab,
          'latitude'      =>$lat,
          'longitude'     =>$long,
          'latitudeRumah' =>$latitudeRumah,
          'longitudeRumah'=>$longitudeRumah,
          'saldo'         =>$saldo,
          'level'         =>3,
          'verifikasi'    =>"true"
      ]);

    if ($newpost) {
      echo '<script type="text/javascript">';
      echo "alert('User ID : $uid and Email :$email Updated!');";
      echo 'window.location.href = "../pages/v_guru.php";';
      echo '</script>';
    }else{
      echo '<script type="text/javascript">alert("Data gagal ditambahkan"); window.history.back() = "../pages/v_guru.php"</script>';
    }
  }else{
    echo '<script type="text/javascript">alert("Kesalahan, Coba Login Ulang");</script>';
  }
}
?>