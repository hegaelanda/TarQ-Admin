<?php
session_start();
include '../database/database.php';
$uid = $_GET['uid'];

$updates = [
    'TARQ/USER/GURU/'.$_SESSION['akses'].'/'.$uid.'/verifikasi' => "true",
];

$reference = $database->getReference()
			->update($updates);

if ($reference) {
	$post = "Success";
}

echo json_encode($post);
?>