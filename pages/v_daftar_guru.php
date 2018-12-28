<?php
session_start();
include 'header.php'; 
include '../database/database_guru.php';
include '../database/database_lembaga.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Daftar Guru <small>(Formulir)</small></h1>
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal" method="POST" action="../func/f_daftar_guru.php">
              <label for="email">Email :</label>
              <input type="email" class="form-control" name="email" placeholder="Masukan Email Guru" required autofocus>
              <br>
              <label for="nohp">Nama Guru :</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Guru" required>
              <br>
              <label for="nohp">No Telepon :</label>
              <input type="text" class="form-control" name="nohp" placeholder="Masukan Nomor Telepon" maxlength="13" required>
              <br>
              <label for="tanggallahir">Tanggal Lahir :</label>
              <br>
              <input type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="tanggallahir" required>
              <br>
              <label for="alamat">Alamat</label>
              <textarea class="form-control" name="alamat" placeholder="Masukan Alamat Guru"></textarea>
              <br>
              <label for="lembaga">Lembaga :</label>
              <select name="lembaga" id="lembaga" class="form-control" onchange="otherCheck(this);" required>
              <?php 
              for ($i=0; $i < count($lembagaArr); $i++) {
              ?>
                <option value="<?php echo $lembagaArr[$i] ?>"><?php echo $lembagaArr[$i]; ?></option> 
              <?php
              }
              ?>
                <option value="other" id="other">Lainnya</option>
              </select>
              <div id="ifOther" style="display: none;">
                <br>
                <input type="text" class="form-control" name="lembagabaru" placeholder="Masukan Lembaga Baru">
              </div>
              <br>
              <label>Keahlian Guru :</label>
              <br>
              <div class="col-sm-2" style="margin-left: -15px;">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="PraTahsin1" value="PraTahsin1">Pra Tahsin 1
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="PraTahsin2" value="PraTahsin2">Pra Tahsin 2
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="PraTahsin3" value="PraTahsin3">Pra Tahsin 3
                  </label>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin1" value="Tahsin1">Tahsin 1
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin2" value="Tahsin2">Tahsin 2
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin3" value="Tahsin3">Tahsin 3
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahsin4" value="Tahsin4">Tahsin 4
                  </label>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="Tahfizh" value="">Tahfizh
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="BahasaArab" value="BahasaArab">Bahasa Arab
                  </label>
                </div>
              </div>
              <br><br><br><br><br><br><br>
              <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Submit</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
            </form>
            <hr>
            <h1 class="page-header">Daftar Guru <small>(Import CSV)</small></h1>
            <form method="POST" enctype="multipart/form-data" action="../func/f_importCsv.php">
              <label for="lembagacsv">Lembaga :</label>
              <select name="lembagacsv" id="lembagacsv" class="form-control" onchange="otherCheckCsv(this);" required>
              <?php 
              for ($i=0; $i < count($lembagaArr); $i++) {
              ?>
                <option value="<?php echo $lembagaArr[$i] ?>"><?php echo $lembagaArr[$i]; ?></option> 
              <?php
              }
              ?>
                <option value="other" id="othercsv">Lainnya</option>
              </select>
              <div id="ifOtherCsv" style="display: none;">
                <br>
                <input type="text" class="form-control" name="lembagabarucsv" placeholder="Masukan Lembaga Baru">
              </div>
              <br>
              <label for="fileInput">File CSV :</label>
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
<script>
  function otherCheck(that) {
        if (that.value == "other") {
            document.getElementById("ifOther").style.display = "block";
        } else {
            document.getElementById("ifOther").style.display = "none";
        }
    }
    function otherCheckCsv(that) {
        if (that.value == "other") {
            document.getElementById("ifOtherCsv").style.display = "block";
        } else {
            document.getElementById("ifOtherCsv").style.display = "none";
        }
    }
</script>
<?php include 'footer.php'; ?>