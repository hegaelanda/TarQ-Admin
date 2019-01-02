<?php
session_start();
include 'header.php';
include '../database/database.php';
$kelas = $_GET['id'];
$time = $_GET['time'];
$reference = $database->getReference('TARQ/FORM/'.$_SESSION['akses'].'/'.$kelas.'/'.$time);
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();

?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Detail Jadwal</h1>
        <div class="row">
          <div class="col-lg-12">
                <?php 
                $guru = $_GET['guru'];
                $time = $_GET['time'];
                $arr = explode(",", $value['jadwalhari']);
                 ?>
                 <h4>Guru : <?php echo $guru; ?></h4>
                 <h4>Tanggal : <?php date_default_timezone_set('Asia/Jakarta'); echo date('r', $time); ?></h4>
            <div class="panel panel-default">
              <div class="panel-heading">
                Jadwal
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Murid</th>
                      <th>Tanggal</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    for ($i=1; $i <= count($arr); $i++) { 
                      if (isset($arr[$i]) && $arr[$i] != "") {
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php date_default_timezone_set('Asia/Jakarta'); echo date('r', $arr[$i]); ?></td>
                          <td align="center"><a class="btn btn-primary" href="v_detail_absen_p.php?id=<?php echo $kelas ?>+time=<?php echo $arr[$i] ?>"><i class="fa fa-arrow-right"></i></a></td>
                        </tr>
                        <?php 
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
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<?php include 'footer.php'; ?>