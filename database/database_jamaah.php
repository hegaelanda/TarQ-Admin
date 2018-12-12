<?php 
include 'database.php';

$reference = $database->getReference('TARQ/USER/JAMAAH');
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>