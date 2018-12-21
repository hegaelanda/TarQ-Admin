<?php
include 'header.php'; 
include '../database/database_kelas.php';
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
                      <th>No</th>
                      <th>ID KELAS</th>
                      <th>Guru</th>
                      <th>Jamaah</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($value as $key => $val) {
                      if (isset($val['jadwalhari'])) {
                        if ($val['jadwalhari']!=='request' && $val['jadwalhari']!=='process') {
                          ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $key ?></td>
                            <td><?php echo $val['guru'] ?></td>
                            <td><?php echo $val['guru']; ?></td>
                            <td><a class="btn btn-primary" href="v_detail_jadwal.php?id=<?php echo $key ?>"><i class="fa fa-arrow-right"></i></a></td>
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