<?php session_start(); ?>
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
// error_reporting(0);
include '../database/database.php';

switch ($_SESSION['akses']) {
  case 'BANDUNG':
    $lat = '-6.894144';
    $lng = '107.629769';
    break;
  
  case 'PADANG':
    $lat = '-0.239182';
    $lng = '100.610456';
    break;

  default:
    # code...
    break;
}

//ambil guru
$guru = $_POST['guru'];
$refguru= $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses'].'/'.$guru);
$snapguru = $refguru->getSnapshot();
$valguru = $snapguru->getValue();

$namaguru = $valguru['nama'];

//ambil jamaah
$murid = $_POST['murid'];
$arrnamamurid = array();
$arridmurid = array();
$keys = array_keys($database->getReference('TARQ/KELAS/KANTOR/'.$_SESSION['akses'])->shallow()->getValue());

for ($m=0; $m < count($murid) ; $m++) { 
  ${"refmurid$m"} = $database->getReference('TARQ/USER/JAMAAH/'.$_SESSION['akses'].'/'.$murid[$m]);
  ${"snapmurid$m"} = ${"refmurid$m"}->getSnapshot();
  ${"valmurid$m"} = ${"snapmurid$m"}->getValue();

  array_push($arrnamamurid, ${"valmurid$m"}['nama']);
  array_push($arridmurid, ${"valmurid$m"}['id_user']);
}

//set variable otw firebase
$newnamamurid = implode(",", $arrnamamurid);
$newidmurid = implode(",", $arridmurid);
$pel = $_GET['pel'];
$per = $_GET['per'];
$waktu = $_POST['waktu'];

//set looping tergantung pertemuan
if ($per == '4') {
  $loop = 1;
}elseif($per == '8'){
  $loop = 2;
}elseif($per == '12'){
  $loop = 3;
}elseif($per == '16'){
  $loop = 4;
}

//bikin jadwal hari
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
      ${"jadwal$n"} = date('Y-m-d H:i:s', strtotime('+'.$i.' week', strtotime(${"tanggal$j"})));;
      ${"newjadwal$n"} = strtotime(${"jadwal$n"});
      array_push($jadarr, ${"newjadwal$n"});
      $n++;
    }
    $i++;
  }
  $uploadjadwal = implode("000,", $jadarr);
  
  //berangkat ke firebase
  $refrerence = "TARQ/KELAS/KANTOR/".$_SESSION['akses'];
  $newpost = $database
    ->getReference($refrerence)
    ->push([
        'guru'=>$namaguru,
        'murid'=>$newnamamurid,
        'idguru'=>$guru,
        'idmurid'=>$newidmurid,
        'jadwalhari'=>"000,".$uploadjadwal."000,",
        'jmlpertemuan'=>$per,
        'lokasilat'=>$lat,
        'lokasilang'=>$lng,
        'pelajaran'=>$pel
    ]);

  $thekey = $newpost->getKey();
  $nokelas = ['TARQ/KELAS/KANTOR/'.$_SESSION['akses'].'/'.$thekey.'/nokelas' => $thekey];

  $reference = $database->getReference()->update($nokelas);

  for ($m=0; $m < count($murid) ; $m++) { 
    ${"refmurid$m"} = $database->getReference('TARQ/USER/JAMAAH/'.$_SESSION['akses'].'/'.$murid[$m]);
    ${"snapmurid$m"} = ${"refmurid$m"}->getSnapshot();
    ${"valmurid$m"} = ${"snapmurid$m"}->getValue();

    //hapus kelas sebelumnya
    for ($h=0; $h < count($keys); $h++) {
      ${"refkelas$h"} = $database->getReference('TARQ/KELAS/KANTOR/'.$_SESSION['akses'].'/'.$keys[$h]);
      ${"snapkelas$h"} = ${"refkelas$h"}->getSnapshot();
      ${"valkelas$h"} = ${"snapkelas$h"}->getValue();

      if (${"valkelas$h"}['idmurid'] == ${"valmurid$m"}['id_user']) {
          $deletekelas = $database->getReference('TARQ/KELAS/KANTOR/'.$_SESSION['akses'].'/'.$keys[$h])->remove();
      }
    }
  }
  //feedback
  if ($newpost) {
    echo "<script>
      alert('Success');
      window.location.href='../pages/v_request_kantor.php';
      </script>";
  }
}

?>