<?php 

include '../database/database.php';
$kelas = $_GET['id'];

$ref = $database->getReference('TARQ/KELAS/PRIVATE/'.$kelas);
$sna = $ref->getSnapshot();
$val = $sna->getValue();

var_dump($val);

if ($val['jmlpertemuan'] == 4) {
  $loop = 1;
}elseif($val['jmlpertemuan'] == 8){
  $loop = 2;
}elseif($val['jmlpertemuan'] == 12){
  $loop = 3;
}elseif($val['jmlpertemuan'] == 16){
  $loop = 4;
}

if (isset($_POST['tanggal1'])) {
  for ($i=1; $i <= $loop; $i++) { 
    $tanggal.$i = $_POST['tanggal'.$i];
  }
  
  $awal = $tanggal1;
  $akhir = $tanggal.$loop;

  $refrerence = "TARQ/KELAS/PRIVATE/".$kelas;
  $newpost = $database
    ->getReference($refrerence)
    ->set([
        'nokelas'=>$kelas,
        'guru'=>$val['guru'],
        'murid'=>$val['murid'],
        'idguru'=>$val['idguru'],
        'idmurid'=>$val['idmurid'],
        'jadwalhari'=>$newhari,
        'jadwalawal'=>$awal,
        'jadwalakhir'=>$akhir,
        'jmlpertemuan'=>$val['jmlpertemuan'],
    ]);
}

?>