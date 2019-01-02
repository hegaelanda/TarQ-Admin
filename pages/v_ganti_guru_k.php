<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<?php
session_start();
include 'header.php';
$id = $_GET['id'];
include '../database/database.php';
$reference = $database->getReference('TARQ/KELAS/KANTOR/'.$_SESSION['akses'].'/'.$id);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();

$refguru = $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses']);
$refsnap = $refguru->getSnapshot();
$refval = $refsnap->getValue();
?>

<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Ganti Guru</h1>
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal" method="POST" action="../func/f_ganti_guru_k.php?id=<?php echo $id;?>">
              <label for="waktu">Guru Baru :</label>
              <select name="guru" id="guru" class="form-control">
                <option value="">Pilih Guru Baru</option>
                <?php 
                  foreach ($refval as $key => $val) {
                    if (isset($val['nama'])) {
                      if ($val['verifikasi'] == 'true') {
                  ?>
                    <option value="<?php echo $key; ?>"><?php echo $val['nama']; ?>  (<?php echo $val['id_user']; ?>)</option>
                  <?php
                      }
                    }
                  }
                 ?>
               </select>
              <br>
              <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Submit</button>
              <br><br><br><br>
            </form>
          <!-- /.col-lg-12 -->
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>

<script>
  var timepicker = new TimePicker('time', {
  lang: 'en',
  theme: 'dark'
  });
  timepicker.on('change', function(evt) {
    
    var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    evt.element.value = value;

  });

</script>

<?php include 'footer.php';
?>