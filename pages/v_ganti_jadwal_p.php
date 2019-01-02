<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<?php
session_start();
include 'header.php';
$id = $_GET['id'];
include '../database/database.php';
$reference = $database->getReference('TARQ/KELAS/PRIVATE/'.$_SESSION['akses'].'/'.$id);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
?>

<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Ganti Jadwal</h1>
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal" method="POST" action="../func/f_ganti_jadwal_p.php?id=<?php echo $id;?>">
              <label for="pertemuanke">Pilih Pertemuan :</label>
              <select name="pertemuanke" id="pertemuanke" class="form-control">
                <?php 
                for ($i=1; $i <= $value['jmlpertemuan'] ; $i++) { 
                ?>
                <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                <?php
                } 
                ?>
              </select>
              <br>
              <label for="waktu">Waktu Baru :</label>
              <input type="text" name="waktu" id="time" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;">
              <br>
              <label for="jadwalbaru">Jadwal Baru :</label>
              <br>
              <input type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="jadwalbaru" required>
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