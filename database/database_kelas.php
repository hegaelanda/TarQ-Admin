<?php 
include 'database.php';

$reference = $database->getReference('TARQ/KELAS/PRIVATE');
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>