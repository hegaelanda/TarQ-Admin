<?php 
include 'database.php';

$reference = $database->getReference('TARQ/Lembaga/lembaga');
$snapshot = $reference->getSnapshot();
$valueLembaga = $snapshot->getValue();
$lembagaArr = explode(",", $valueLembaga);
?>