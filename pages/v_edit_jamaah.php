<?php
session_start();
include 'header.php';
$id = $_GET['id'];
include '../database/database.php';
$reference = $database->getReference('TARQ/USER/JAMAAH/'.$_SESSION['akses'].'/'.$id);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();

$user = $auth->getUser($id);
$email = $user->email;

$tanggallahir = DateTime::createFromFormat('d/m/Y', $value['tanggallahir']);
$newDate = $tanggallahir->format('Y-m-d');
?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit Jamaah</h1>
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal" method="POST" action="../func/f_edit_jamaah.php?id=<?php echo $id;?>">
              <label for="email">Email :</label>
              <input type="email" class="form-control" name="email" placeholder="Masukan Email Jamaah" value="<?php echo $email; ?>" required readonly>
              <br>
              <label for="nohp">Nama Jamaah :</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Jamaah" value="<?php echo $value['nama']; ?>" required>
              <br>
              <label for="nonik">Nomer NIK :</label>
              <input type="text" class="form-control" name="nonik" placeholder="Masukan Nama Jamaah" value="<?php echo $value['noNIK']; ?>" required>
              <br>
              <label for="nohp">No Telepon :</label>
              <input type="text" class="form-control" name="nohp" placeholder="Masukan Nomor Telepon" maxlength="13" value="<?php echo $value['nohp']; ?>" required>
              <br>
              <label for="tanggallahir">Tanggal Lahir :</label>
              <br>
              <input type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="tanggallahir" value="<?php echo $newDate ?>" required>
              <br>
              <label for="alamat">Alamat</label>
              <textarea class="form-control" name="alamat" placeholder="Masukan Alamat Jamaah"><?php echo $value['alamat'];; ?></textarea>
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

<?php include 'footer.php';
?>