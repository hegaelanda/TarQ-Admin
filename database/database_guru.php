<?php 
include 'database.php';

$reference = $database->getReference('TARQ/USER/GURU');
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>