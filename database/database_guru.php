<?php
include 'database.php';
$reference = $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses']);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>