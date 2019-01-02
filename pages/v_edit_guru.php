<?php
session_start();
include 'header.php';
$id = $_GET['id'];
include '../database/database.php';
$reference = $database->getReference('TARQ/USER/GURU/'.$_SESSION['akses'].'/'.$id);
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
        <h1 class="page-header">Edit Guru</h1>
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal" method="POST" action="../func/f_edit_guru.php?id=<?php echo $id;?>&l=<?php echo $value['lembaga'];?>">
              <label for="email">Email :</label>
              <input type="email" class="form-control" name="email" placeholder="Masukan Email Guru" value="<?php echo $email; ?>" required readonly>
              <br>
              <label for="nohp">Nama Guru :</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Guru" value="<?php echo $value['nama']; ?>" required>
              <br>
              <label for="nohp">No Telepon :</label>
              <input type="text" class="form-control" name="nohp" placeholder="Masukan Nomor Telepon" maxlength="13" value="<?php echo $value['nohp']; ?>" required>
              <br>
              <label for="tanggallahir">Tanggal Lahir :</label>
              <br>
              <input type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="tanggallahir" value="<?php echo $newDate ?>" required>
              <br>
              <label for="alamat">Alamat</label>
              <textarea class="form-control" name="alamat" placeholder="Masukan Alamat Guru"><?php echo $value['alamat'];; ?></textarea>
              <br>
              <label>Keahlian Guru :</label>
              <?php 
                if ($value['pratahsin1'] == 'true') {
                  $PraTahsin1 = "checked";
                }else{
                  $PraTahsin1 = "";
                }
                if ($value['pratahsin2'] == 'true') {
                  $PraTahsin2 = "checked";
                }else{
                  $PraTahsin2 = "";
                }
                if ($value['pratahsin3'] == 'true') {
                  $PraTahsin3 = "checked";
                }else{
                  $PraTahsin3 = "";
                }
                if ($value['tahsin1'] == 'true') {
                  $Tahsin1 = "checked";
                }else{
                  $Tahsin1 = "";
                }
                if ($value['tahsin2'] == 'true') {
                  $Tahsin2 = "checked";
                }else{
                  $Tahsin2 = "";
                }
                if ($value['tahsin3'] == 'true') {
                  $Tahsin3 = "checked";
                }else{
                  $Tahsin3 = "";
                }
                if ($value['tahsin4'] == 'true') {
                  $Tahsin4 = "checked";
                }else{
                  $Tahsin4 = "";
                }
                if ($value['tahfizh'] == 'true') {
                  $Tahfizh = "checked";
                }else{
                  $Tahfizh = "";
                }
                if ($value['bahasaarab'] == 'true') {
                  $BahasaArab = "checked";
                }else{
                  $BahasaArab = "";
                }
               ?>
              <br>
              <div class="col-sm-2" style="margin-left: -15px;">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="PraTahsin1" value="PraTahsin1" <?php echo $PraTahsin1; ?>>Pra Tahsin 1
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="PraTahsin2" value="PraTahsin2" <?php echo $PraTahsin2; ?>>Pra Tahsin 2
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="PraTahsin3" value="PraTahsin3" <?php echo $PraTahsin3; ?>>Pra Tahsin 3
                  </label>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin1" value="Tahsin1" <?php echo $Tahsin1; ?>>Tahsin 1
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin2" value="Tahsin2" <?php echo $Tahsin2; ?>>Tahsin 2
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin3" value="Tahsin3" <?php echo $Tahsin3; ?>>Tahsin 3
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin4" value="Tahsin4" <?php echo $Tahsin4; ?>>Tahsin 4
                  </label>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahfizh" value="Tahfizh" <?php echo $Tahfizh; ?>>Tahfizh
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="BahasaArab" value="BahasaArab" <?php echo $BahasaArab; ?>>Bahasa Arab
                  </label>
                </div>
              </div>
              <br><br><br><br><br><br><br>
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