<?php
include 'header.php'; 
include '../database/database_jamaah.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">List Jamaah</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Jamaah
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No HP</th>
                                            <th>Created At</th>
                                            <th>Last Login At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; $i = 'tidak_ada';
                                          foreach ($value as $key => $val) {
                                            if (isset($val['nama'])) {
                                            $user = $auth->getUser($key);
                                              ?>
                                              <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $val['nama']; ?></td>
                                                <td><?php echo $val['nohp']; ?></td>
                                                <td id="createdAt">
                                                  <?php
                                                  $createdAt = $user->metadata->createdAt;
                                                  echo $createdAt->format('d / M / Y');
                                                  ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $lastLoginAt = $user->metadata->lastLoginAt;
                                                    if ($lastLoginAt != NULL){
                                                        echo $lastLoginAt->format('d / M / Y');
                                                    }else{
                                                        echo "Belum Login";
                                                    }
                                                     ?>
                                                </td>
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