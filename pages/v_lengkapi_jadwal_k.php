<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<?php
include 'header.php'; 

include '../database/database.php';
$kelas = $_GET['id'];

$ref = $database->getReference('TARQ/KELAS/KANTOR/'.$kelas);
$sna = $ref->getSnapshot();
$val = $sna->getValue();

if ($val['jmlpertemuan'] == 4) {
  $loop = 1;
}elseif($val['jmlpertemuan'] == 8){
  $loop = 2;
}elseif($val['jmlpertemuan'] == 12){
  $loop = 3;
}elseif($val['jmlpertemuan'] == 16){
  $loop = 4;
}
echo "<script>var loop = $loop;</script>";
?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Lengkapi Jadwal</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Form Jadwal
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="../func/f_jadwal_k.php?id=<?php echo $kelas ?>">
            <label for="waktu">Waktu :</label>
            <input type="text" name="waktu" id="time" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;">
            <br>
          <?php 
            for ($i=1; $i <= $loop; $i++) { 
           ?>
            <label for="tgl">Pertemuan <?php echo $i ?> :</label>
            <input onchange="tanggalhari();" type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="tanggal<?php echo $i ?>" id="tanggal<?php echo $i ?>"required>
            <br>
            <input type="text" class="form-control" id="hari<?php echo $i ?>" placeholder="Nama Hari" name="hari<?php echo $i ?>" readonly>
            <br>
          <?php 
            }
           ?>
           <input type="submit" class="btn btn-primary" value="Submit">
          </form>
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
  </div>
</div>
<!-- /#page-wrapper -->
<!-- /.container-fluid -->(
</div>
<!-- /#page-wrapper -->
</div>

<script>
  function tanggalhari(){
    var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
    console.log(loop)
    for (var i = 1; i <= loop; i++) {
      var d = new Date(document.getElementById("tanggal" + i).value);
      var n = d.getDay();
      var k = days[n];
      document.getElementById("hari" + i).value = k;
    }
  }

  var timepicker = new TimePicker('time', {
  lang: 'en',
  theme: 'dark'
  });
  timepicker.on('change', function(evt) {
    
    var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    evt.element.value = value;

  });

</script>


<?php include 'footer.php'; ?>