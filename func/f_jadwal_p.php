<div align="center" class="lds-css ng-scope" id="load"><div style="width:100%;height:100%" class="lds-double-ring"><div></div><div></div></div><style type="text/css">@keyframes lds-double-ring {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes lds-double-ring {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes lds-double-ring_reverse {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
@-webkit-keyframes lds-double-ring_reverse {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
.lds-double-ring {
  position: relative;
}
.lds-double-ring div {
  position: absolute;
  width: 160px;
  height: 160px;
  top: 20px;
  left: 20px;
  border-radius: 50%;
  border: 8px solid #000;
  border-color: #28292f transparent #28292f transparent;
  -webkit-animation: lds-double-ring 1s linear infinite;
  animation: lds-double-ring 1s linear infinite;
}
.lds-double-ring div:nth-child(2) {
  width: 140px;
  height: 140px;
  top: 30px;
  left: 30px;
  border-color: transparent #0a0a0a transparent #0a0a0a;
  -webkit-animation: lds-double-ring_reverse 1s linear infinite;
  animation: lds-double-ring_reverse 1s linear infinite;
}
.lds-double-ring {
  width: 200px !important;
  height: 200px !important;
  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
}
</style></div>
<?php 
error_reporting(0);
include '../database/database.php';
$kelas = $_GET['id'];

$ref = $database->getReference('TARQ/KELAS/PRIVATE/'.$kelas);
$sna = $ref->getSnapshot();
$val = $sna->getValue();

$newref = $database->getReference('TARQ/KELAS/PRIVATE');
$newsna = $newref->getSnapshot();
$newval = $newsna->getValue();

$newdb = $database->getReference('TARQ/KELAS/PRIVATE')->getChildKeys();

for ($z=0; $z < count($newdb); $z++) { 
  if ($newval[$newdb[$z]]['idguru'] == $val['idguru'] && $newval[$newdb[$z]]['jadwalhari'] != 'request') { 
    $banding = $newval[$newdb[$z]]['jadwalhari'];
    // $newbanding = explode('000,',$banding);
    // print_r($banding);
  }
}
// var_dump($newval['']);
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
  $newupload = "000,".$uploadjadwal."000,";
  // echo "<br><br>";
  // print_r($newupload);
  if ($newupload != $banding) {
    $refrerence = "TARQ/KELAS/PRIVATE/".$kelas;
    $newpost = $database
      ->getReference($refrerence)
      ->set([
          'nokelas'=>$kelas,
          'guru'=>$val['guru'],
          'murid'=>$val['murid'],
          'idguru'=>$val['idguru'],
          'idmurid'=>$val['idmurid'],
          'jadwalhari'=>$newupload,
          'jmlpertemuan'=>$val['jmlpertemuan'],
          'lokasilat'=>$val['lokasilat'],
          'lokasilang'=>$val['lokasilang'],
          'pelajaran'=>$val['pelajaran'],
    ]);
    if ($newpost) {
      echo "<script>alert('Success');window.location.href='../pages/v_request_private.php';</script>";
    }
  }else{
    echo "<script>alert('Ada Jadwal Yang Sama');window.history.back();</script>";
  }
}

?>