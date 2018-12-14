<?php
require '../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('../database/lkptarq93-firebase-adminsdk-hrybb-331d42bc6b.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://lkptarq93.firebaseio.com')
    ->create();

$database = $firebase->getDatabase();

if (isset($_POST['email'])) {

  

  $userProperties = [
      'email' => $email,
      'emailVerified' => false,
      'password' => '12341234',
      'displayName' => $nama,
      'disabled' => false
  ];

  $createdUser = $auth->createUser($userProperties);

  $key = $auth->getUserByEmail($email);
  
  $uid = $key->uid;
  $refrerence = "TARQ/USER/GURU/".$uid;
  $newpost = $database
    ->getReference($refrerence)
    ->set([
        'id_user'=>$uid,
        'nama'=>strtoupper($nama),
        'nohp'=>$nohp,
        'tanggallahir'=>$newDate,
        'alamat'=>strtoupper($alamat),
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