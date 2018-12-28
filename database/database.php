<?php 
require '../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/lkptarq93-firebase-adminsdk-hrybb-331d42bc6b.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://lkptarq93.firebaseio.com')
    ->create();

$database = $firebase->getDatabase();
$auth = $firebase->getAuth();
?>