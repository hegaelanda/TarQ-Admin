<?php
session_start();

$id_admin = $_GET['id'];
$akses = $_GET['akses'];

$_SESSION['id_admin'] = $id_admin;
$_SESSION['akses'] = $akses;

if (isset($_SESSION['id_admin'])&&isset($_SESSION['akses'])) {
  if ($_SESSION['akses'] == "SUPER") {
    echo "<script>window.location.href='admin.php';</script>";  
  }else{
    echo "<script>window.location.href='index.php';</script>";
  }
}
?>
<div align="center" class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-double-ring"><div></div><div></div></div><style type="text/css">@keyframes lds-double-ring {
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
