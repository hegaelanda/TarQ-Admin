<?php
include 'database.php';
$reference = $database->getReference('TARQ/ADMIN');
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>