<?php
include 'header.php'; 
include '../database/database_guru.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Daftar Guru <small>(Formulir)</small></h1>
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal" method="POST" action="vdaftar_penerima.php">
              <label for="email">Email :</label>
              <input type="email" class="form-control" name="email" placeholder="Masukan Email Guru" required>
              <br>
              <label for="nohp">Nama Guru :</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Guru" required>
              <br>
              <label for="nohp">No Telepon :</label>
              <input type="tel" class="form-control" name="nohp" placeholder="Masukan Nomor Telepon" maxlength="13" required>
              <br>
              <label for="tanggallahir">Tanggal Lahir :</label>
              <br>
              <input type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" style="" name="tanggallahir" required>
              <br><br>
              <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Submit</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
            </form>
            <hr>
            <h1 class="page-header">Daftar Guru <small>(Import CSV)</small></h1>
            <form method="POST" and enctype="multipart/form-data"  action="importCsv.php">
              <label for="nohp">File CSV :</label>
              <input type="file" id="fileInput" accept=".csv" name="csv">
              <br>
              <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Submit</button>
              <br><br>
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
<?php include 'footer.php'; ?>