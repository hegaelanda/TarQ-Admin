<?php 
include 'database.php';

$reference = $database->getReference('TARQ/KELAS/PRIVATE/'.$_SESSION['akses']);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>