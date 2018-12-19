<?php 
error_reporting(0);
include '../database/database.php';
$kelas = $_GET['id'];

$ref = $database->getReference('TARQ/KELAS/PRIVATE/'.$kelas);
$sna = $ref->getSnapshot();
$val = $sna->getValue();

if ($val['jmlpertemuan'] == '4') {
  $loop = 1;
}elseif($val['jmlpertemuan'] == '8'){
  $loop = 2;
}elseif($val['jmlpertemuan'] == '12'){
  $loop = 3;
}elseif($val['jmlpertemuan'] == '16'){
  $loop = 4;
}
$waktu = $_POST['waktu'];

if (isset($_POST['tanggal1'])) {
  for ($i=1; $i <= $loop; $i++) { 
    ${"tgl$i"} = $_POST["tanggal$i"];
    ${"tanggal$i"} = ${"tgl$i"}.' '.$waktu.':00';
  }
  $jadarr = array();
  $n = 1;
  $i = 0;
  while($i < 4){
    for ($j=1; $j <= $loop ; $j++) { 
      date_default_timezone_set('Asia/Jakarta');
      ${"jadwal$n"} = date('Y-m-d h:i:s', strtotime('+'.$i.' week', strtotime(${"tanggal$j"})));;
      ${"newjadwal$n"} = strtotime(${"jadwal$n"});
      array_push($jadarr, ${"newjadwal$n"});
      $n++;
    }
    $i++;
  }
  $uploadjadwal = implode("000,", $jadarr);
  $refrerence = "TARQ/KELAS/PRIVATE/".$kelas;
  $newpost = $database
    ->getReference($refrerence)
    ->set([
        'nokelas'=>$kelas,
        'guru'=>$val['guru'],
        'murid'=>$val['murid'],
        'idguru'=>$val['idguru'],
        'idmurid'=>$val['idmurid'],
        'jadwalhari'=>"000,".$uploadjadwal."000,",
        'jmlpertemuan'=>$val['jmlpertemuan'],
    ]);
    if ($newpost) {
      echo "<script>
        alert('Success');
        window.location.href='../pages/v_request_pengajaran.php';
        </script>";
    }
}

?>