<?php
include 'database.php';
$uid = $_GET['uid'];

$reference = $database->getReference('TARQ/USER/GURU/'.$uid)->remove();
$auth->deleteUser($uid);

if ($uid && $auth) {
	$post = "Success";
}

echo json_encode($post);
?>