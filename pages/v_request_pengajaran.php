<?php
include 'header.php'; 
include '../database/database_jamaah.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Request Pengajaran</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Request
                            <button class="btn btn-primary" data-toggle="modal" data-target="#detailModal" id="test">TEST</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jamaah</th>
                                        <th>Guru</th>
                                        <th>ID Pengajaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; $i = 'tidak_ada';
                                      foreach ($value as $key => $val) {
                                        $user = $auth->getUser($key);
                                        if (isset($val['id_user'])) {
                                          if (isset($val['request'])&&$val['request']=='true') {
                                          ?>
                                              <tr>
                                                  <td><?php echo $no++; ?></td>
                                                  <td><?php echo $val['id_user']; ?></td>
                                                  <td><?php echo $val['nama']; ?></td>
                                                  <td><?php echo $val['nohp']; ?></td>
                                                  <td><a href="" class="btn btn-primary"><i class="fa fa-arrow-right"></i></a></td>
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
        <!-- /#page-wrapper -->
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Lengkapi Jadwal</h4>
      </div>
      <div class="modal-body">
        <form action="../func/f_jadwal.php" method="POST">
          <label for="hari1">Pertemuan ke-1 :</label>
          <input type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="hari1" required>
          <br>
          <label for="hari2">Pertemuan ke-2 :</label>
          <input type="date" style="display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;" name="hari2" required>
          <br>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" type="button" href="#" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" type="button" href="#" id="accept">Submit</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php include 'footer.php'; ?>