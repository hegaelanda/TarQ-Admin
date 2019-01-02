<?php
session_start();
include 'header.php'; 
include '../database/database_kantor.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">List Jadwal</h1>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Jadwal
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th style="width: 16.66%">No</th>
                      <th>ID KELAS</th>
                      <th>Guru</th>
                      <th>Jamaah</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($valuek as $keyk => $valk) {
                      if (isset($valk['jadwalhari'])) {
                        if ($valk['jadwalhari']!=='request' && $valk['jadwalhari']!=='process') {
                          $newmurid = explode(",", $valk['murid']);
                          for ($o=0; $o < count($newmurid) ; $o++) { 
                            ${"themurid$o"} = $newmurid[$o];
                          }
                          ?>
                          <tr>
                            <td style="width: 10%;"><?php echo $no++; ?></td>
                            <td><?php echo $keyk ?></td>
                            <td><?php echo $valk['guru'] ?></td>
                            <td><?php 
                                for ($j=0; $j < count($newmurid) ; $j++) {
                                  $r = $j+1;
                                  echo $r.". ".${"themurid$j"}."<br>";
                                }
                            ?></td>
                            <a class="btn btn-primary" href="v_detail_jadwal_k.php?id=<?php echo $keyk ?>">
                                Absen
                              </a>
                              <a class="btn btn-warning" href="v_ganti_guru_k.php?id=<?php echo $keyk ?>">
                                Ganti Guru
                              </a>
                              <a class="btn btn-info" href="v_ganti_jadwal_k.php?id=<?php echo $keyk ?>">
                                Ganti Jadwal
                              </a>
                          </tr>
                          <?php 
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
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<?php include 'footer.php'; ?>