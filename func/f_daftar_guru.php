<?php
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

$auth = $firebase->getAuth();

if (isset($_POST['email'])) {
  
  $email   = $_POST['email'];
  $nama    = $_POST['nama'];
  $nohp    = $_POST['nohp'];
  $lembaga = $_POST['lembaga'];
  if ($lembaga == "other") {
    $lembaga   = strtoupper($_POST['lembagabaru']);
    $ambil     = $database->getReference('TARQ/Lembaga/lembaga');
    $snap      = $ambil->getSnapshot();
    $vlembaga  = $snap->getValue();

    $ambilbaru   = 'TARQ/Lembaga';
    $lembagapost = $database
    ->getReference($ambilbaru)
    ->set([
        'lembaga'=>$vlembaga.','.$lembaga
    ]);
  }
  $tanggallahir = $_POST['tanggallahir'];
  $newDate = date("d-m-Y", strtotime($tanggallahir));
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

  $userProperties = [
      'email'         => $email,
      'emailVerified' => false,
      'password'      => '12341234',
      'displayName'   => $nama,
      'disabled'      => false
  ];

  $createdUser = $auth->createUser($userProperties);

  $key = $auth->getUserByEmail($email);

  //set guru baru
  $uid = $key->uid;
  $refrerence = "TARQ/USER/GURU/".$uid;
  $newpost = $database
    ->getReference($refrerence)
    ->set([
<<<<<<< HEAD
        'id_user'=>$uid,
        'nama'=>strtoupper($nama),
        'nohp'=>$nohp,
        'tanggallahir'=>$newDate,
        'alamat'=>strtoupper($alamat),
        'lembaga'=>$lembaga,
        'pratahsin1'=>$PraTahsin1,
        'pratahsin2'=>$PraTahsin2,
        'pratahsin3'=>$PraTahsin3,
        'tahsin1'=>$Tahsin1,
        'tahsin2'=>$Tahsin2,
        'tahsin3'=>$Tahsin3,
        'tahfizh'=>$Tahfizh,
        'bahasaarab'=>$BahasaArab,
        'latitude'=>'0',
        'longitude'=>'0',
        'level'=>3,
        'verifikasi'=>"true"
=======
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
        'tahfizh'       =>$Tahfizh,
        'bahasaarab'    =>$BahasaArab,
        'latitude'      =>'0',
        'longitude'     =>'0',
        'level'         =>3,
        'verifikasi'    =>"true"
>>>>>>> 55652297c7144162c33b7c1f7db111fd2ab83309
    ]);

  if ($newpost) {
    echo '<script type="text/javascript">';
    echo "alert('User ID : $uid Email :$email Password : 12341234');";
    echo 'window.location.href = "../pages/v_guru.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">alert("Data gagal ditambahkan");</script>';
  }
}

include 'v_daftar_penerima.php';
?>