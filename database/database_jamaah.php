<?php 
include 'database.php';

$reference = $database->getReference('TARQ/USER/JAMAAH/'.$_SESSION['akses']);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>