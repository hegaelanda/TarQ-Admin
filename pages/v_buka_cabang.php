<?php
session_start();
include 'head_admin.php'; 
?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Buka Cabang</h1>
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal" method="POST" action="../func/f_buka_cabang.php">
              <label for="email">Email :</label>
              <input type="email" class="form-control" name="email" placeholder="Masukan Email Guru" required autofocus>
              <br>
              <label for="nohp">Nama Admin :</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Guru" required>
              <br>
              <label for="nohp">Password :</label>
              <input type="password" class="form-control" name="pass" placeholder="Password" required>
              <br>
              <label for="nohp">Confirm Password :</label>
              <input type="password" class="form-control" name="conpass" placeholder="Confirm Password" required>
              <br>
              <label for="nohp">Hak Akses :</label>
              <input type="text" class="form-control" name="akses" placeholder="Lokasi Hak Akses" required>
              <br><br>
              <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Submit</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
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