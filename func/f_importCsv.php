<?php
session_start();
include '../database/database.php';

// Set your CSV feed
if (isset($_FILES['csv']['name']) && isset($_POST['lembagacsv']) && isset($_SESSION['akses'])) {
	$lembaga = $_POST['lembagacsv'];
	if ($lembaga == "other") {
	    $lembaga   = strtoupper($_POST['lembagabarucsv']);
	    $ambil     = $database->getReference('TARQ/Lembaga/lembaga');
	    $snap      = $ambil->getSnapshot();
	    $vlembaga  = $snap->getValue();

	    $ambilbaru   = 'TARQ/Lembaga';
	    $lembagapost = $database
	    ->getReference($ambilbaru)
	    ->set([
	        'lembaga'=>$vlembaga.','.$lembaga
	    ]);
	}
	$feed = $_FILES['csv']['tmp_name'];
	// Arrays we'll use later
	$keys = array();
	$newArray = array();
	// Function to convert CSV into associative array
	function csvToArray($file, $delimiter) { 
	  if (($handle = fopen($file, 'r')) !== FALSE) { 
	    $i = 0; 
	    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
			for ($j = 0; $j < count($lineArray); $j++) { 
				$arr[$i][$j] = $lineArray[$j]; 
			} 
			$i++; 
	    } 
	    fclose($handle);
	  } 
	  return $arr; 
	} 
	// Do it
	$data = csvToArray($feed, ',');
	// Set number of elements (minus 1 because we shift off the first row)
	$count = count($data) - 1;
	  
	//Use first row for names  
	$labels = array_shift($data);  
	foreach ($labels as $label) {
	  $keys[] = $label;
	}
	// Add Ids, just in case we want them later
	$keys[] = 'id';
	for ($i = 0; $i < $count; $i++) {
	  $data[$i][] = $i;
	}
	  
	// Bring it all together
	for ($j = 0; $j < $count; $j++) {
	  $d = array_combine($keys, $data[$j]);
	  $newArray[$j] = $d;
	}

	$data = $newArray;

	for ($i=0; $i < count($data) ; $i++) { 
		$userProperties = [
		  'email'         => $data[$i]['email'],
		  'emailVerified' => true,
		  'password'      => '12341234',
		  'displayName'   => $data[$i]['nama'],
		  'disabled'      => false
		  ];

		$createdUser = $auth->createUser($userProperties);

		$key 		 = $auth->getUserByEmail($data[$i]['email']);

		$uid		 = $key->uid;
		$refrerence  = "TARQ/USER/GURU/".$_SESSION['akses']."/".$uid;
		$newpost 	 = $database
	    	->getReference($refrerence)
		    ->set([
		        'id_user'		=>$uid,
		        'nama'			=>strtoupper($data[$i]['nama']),
		        'nohp'			=>$data[$i]['nohp'],
		        'tanggallahir'	=>$data[$i]['tanggallahir'],
		        'alamat'		=>strtoupper($data[$i]['alamat']),
		        'pratahsin1'	=>strtolower($data[$i]['pratahsin1']),
		        'pratahsin2'	=>strtolower($data[$i]['pratahsin2']),
		        'pratahsin3'	=>strtolower($data[$i]['pratahsin3']),
		        'lembaga'   	=>$lembaga,
		        'tahsin1'		=>strtolower($data[$i]['tahsin1']),
		        'tahsin2'		=>strtolower($data[$i]['tahsin2']),
		        'tahsin3'		=>strtolower($data[$i]['tahsin3']),
		        'tahsin4'		=>strtolower($data[$i]['tahsin4']),
		        'tahfizh'		=>strtolower($data[$i]['tahfizh']),
		        'bahasaarab'	=>strtolower($data[$i]['bahasaarab']),
		        'latitude'		=>'0',
		        'longitude'		=>'0',
		        'latitudeRumah' =>'0',
          		'longitudeRumah'=>'0',
          		'saldo'         =>0,
		        'level'			=>3,
		        'verifikasi'	=>"true"
		    ]);
	}
	header('Location: ../pages/v_guru.php');
}

?>	