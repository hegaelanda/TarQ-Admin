<?php
session_start();
$pel = $_GET['pel'];
$per = $_GET['per'];
if ($per == 4) {
  $loop = 1;
}elseif($per == 8){
  $loop = 2;
}elseif($per == 12){
  $loop = 3;
}elseif($per == 16){
  $loop = 4;
}
echo "<script>var loop = $loop;</script>";
switch ($pel) {
    case 'tahfizh':
        $title = 'Tahfizh';
        break;
    
    case 'bahasaarab':
        $title = 'Bahasa Arab';
        break;

    case 'pratahsin1':
        $title = 'Pra Tahsin 1';
        break;

    case 'pratahsin2':
        $title = 'Pra Tahsin 2';
        break;

    case 'pratahsin3':
        $title = 'Pra Tahsin 3';
        break;

    case 'tahsin1':
        $title = 'Tahsin 1';
        break;

    case 'tahsin2':
        $title = 'Tahsin 2';
        break;

    case 'tahsin3':
        $title = 'Tahsin 3';
        break;

    case 'tahsin4':
        $title = 'Tahsin 4';
        break;

    default:
        $title = 'Unavailable';
        break;
}
include 'header.php'; 
include '../database/database_kantor.php';
include '../database/database_lembaga.php';
include '../database/database_guru.php';
?>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Request <?php echo $title; ?> <small>(<?php echo $per; ?> Pertemuan)</small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary" data-toggle="modal" data-target="#kelasModal">Kelas Baru</button>
            <br><br>
          <div class="panel panel-default">
            <div class="panel-heading">
              List Request Pelajaran <?php echo $title; ?>
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Jamaah</th>
                    <th>Guru</th>
                    <th>ID Murid</th>
                </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($valuek as $key => $val) {
                if (isset($val['jadwalhari'])) {
                  if ($val['jadwalhari']=='request'){
                    if ($val['pelajaran']== $pel){
                      if ($val['jmlpertemuan'] == $per) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $val['murid']; ?></td>
                        <td><?php echo $val['guru']; ?></td>
                        <td><?php echo $val['idmurid'];?></td>
                    </tr>
                    <?php 
                    }
                  }
                }
              }
            }
      ?>
  </tbody>
</table>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
</div>
<!-- /#page-wrapper -->
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- Modal -->
<div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Kelas Baru</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped">
          <form action="../func/f_jadwal_k.php?pel=<?php echo $pel ?>&per=<?php echo $per ?>" method="POST">
          <tr>
            <td>
              <label for="guru">Guru :</label>
              <select name="guru" id="guru" class="form-control" required>
              <?php 
              foreach ($value as $newkey => $newval) {
                if ($newval["$pel"] == 'true') {
                ?>
                  <option value="<?php echo $newval['id_user']; ?>"><?php echo $newval['nama']; ?></option> 
                <?php
                }
              }
              ?>
            </td>
          </tr>
          <tr>
            <td>
              <label for="waktu">Waktu :</label>
              <input type="text" name="waktu" id="time" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;">
            </td>
          </tr>
          <?php 
            for ($i=1; $i <= $loop; $i++) { 
           ?>
           <tr>
             <td>
                <label for="tgl">Pertemuan <?php echo $i ?> :</label>
                <input onchange="tanggalhari();" type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="tanggal<?php echo $i ?>" id="tanggal<?php echo $i ?>"required>
                <br>
                <input type="text" class="form-control" id="hari<?php echo $i ?>" placeholder="Nama Hari" name="hari<?php echo $i ?>" readonly>
             </td>
           </tr>
          <?php 
            }
           ?>
          <tr>
            <td>
              <div class="form-group">
                <label for="">Murid :</label>
                <?php
                foreach ($valuek as $key => $val) {
                  if (isset($val['jadwalhari'])) {
                    if ($val['jadwalhari']=='request'){
                      if ($val['pelajaran']== $pel){
                        if ($val['jmlpertemuan'] == $per) {
                        ?>
                        <div class="checkbox" style="margin-left: 20px;">
                          <input type="checkbox" name="murid[]" value="<?php echo $val['idmurid']; ?>"> <?php echo $val['murid'];?> (<?php echo $val['idmurid'];?>)
                        </div>
                      <?php 
                      }
                    }
                  }
                }
              }
             ?>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" id="decline">Cancel</button>
        <input type="submit" class="btn btn-primary" id="accept" value="Submit">
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
    console.log(value)

  });

</script>
<?php include 'footer.php'; ?>