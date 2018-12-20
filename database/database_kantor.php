<?php 
include 'database.php';

$reference = $database->getReference('TARQ/KELAS/KANTOR');
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>