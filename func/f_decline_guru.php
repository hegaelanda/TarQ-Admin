<?php
session_start();
include 'database.php';
$uid = $_GET['uid'];

$reference = $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses'].'/'.$uid)->remove();
$auth->deleteUser($uid);

if ($uid && $auth) {
	$post = "Success";
}

echo json_encode($post);
?>