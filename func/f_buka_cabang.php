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

$auth = $firebase->getAuth();

if (isset($_POST['email'])) {
  $email    = $_POST['email'];
  $nama     = $_POST['nama'];
  $pass     = $_POST['pass'];
  $conpass  = $_POST['conpass'];
  $akses    = $_POST['akses'];
  if ($pass == $conpass) {
    $userProperties = [
      'email'         => $email,
      'emailVerified' => true,
      'password'      => $pass,
      'displayName'   => $nama,
      'disabled'      => false
    ];

    $createdUser = $auth->createUser($userProperties);

    $key = $auth->getUserByEmail($email);

    //set admin baru
    $uid = $key->uid;
    $refrerence = "TARQ/ADMIN/".$uid;
    $newpost = $database
      ->getReference($refrerence)
      ->set([
          'id'=>$uid,
          'nama'=>$nama,
          'akses'=>strtoupper($akses)
      ]);

    if ($newpost) {
      echo '<script type="text/javascript">';
      echo "alert('User ID : $uid Email :$email Password : $pass');";
      echo 'window.location.href = "../pages/v_admin.php";';
      echo '</script>';
    }else{
      echo '<script type="text/javascript">alert("Data gagal ditambahkan");</script>';
    }
  }else{
    echo '<script type="text/javascript">';
    echo 'window.alert("Password Tidak Sama");';
    echo 'window.history.back()';
    echo '</script>';
  }
}else{
  echo '<script type="text/javascript">';
  echo 'window.alert("Kesalahan, Coba Lagi");';
  echo 'window.history.back()';
  echo '</script>';
}
?>