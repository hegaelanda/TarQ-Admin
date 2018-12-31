<?php 
include 'database.php';

$reference = $database->getReference('TARQ/KELAS/KANTOR/'.$_SESSION['akses']);
$snapshot = $reference->getSnapshot();
$valuek = $snapshot->getValue();
?>