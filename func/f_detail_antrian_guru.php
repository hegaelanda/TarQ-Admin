<?php
session_start();
include '../database/database.php';

$uid = $_GET['uid'];

$reference = $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses'].'/'.$uid);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();

echo json_encode($value);
?>