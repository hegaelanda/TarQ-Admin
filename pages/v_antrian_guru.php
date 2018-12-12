<?php
include 'header.php'; 
include '../database/database_guru.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Antrian Guru</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Antrian Guru Menunggu Persetujuan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Guru</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; $i = 'tidak_ada';
                                      foreach ($value as $key => $val) {
                                        $user = $auth->getUser($key);
                                        if (isset($val['id_user'])) {
                                          if ($val['verifikasi'] == 'false') {
                                          ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $val['id_user']; ?></td>
                                                <td><?php echo $val['nama']; ?></td>
                                                <td><?php echo $val['nohp']; ?></td>
                                                <td align="center"><button class="btn btn-primary" data-toggle="modal" data-target="#detailModal" id="<?php echo $key?>" onclick="showDetails(this);"><i class="fa fa-arrow-right"></i></button></td>
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

<!-- Detail Modal-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Calon Guru</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td colspan="2" class="text-center">
              <img src="" id="picture" width="90" height="90"></img>
            </td>
          </tr>
          <tr>
            <td class="text-center"><b>UID</b></i></td>
            <td><span id="id_user"></span></td>
          </tr>
          <tr>
            <td class="text-center"><i class="fa fa-user"></i></td>
            <td><span id="name"></span></td>
          </tr>
          <tr>
            <td class="text-center"><i class="fa fa-phone"></i></td>
            <td><span id="nohp"></span></td>
          </tr>
          <tr>
            <td class="text-center"><i class="fa fa-map-marker"></i></td>
            <td><span id="alamat"></span>
            </td>
          </tr>      
          <tr>
            <td class="text-center"><b><i class="fa fa-calendar"></i></b></td>
            <td><span id="tanggallahir"></span></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button class="btn btn-danger" type="button" href="#" id="decline">Decline</button>
        <button class="btn btn-success" type="button" href="#" id="accept">Accept</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  function showDetails(button){
    var uid = button.id;
    console.log(uid);
    $.ajax({
      url: "../func/detail_antrian_guru.php",
      method: "GET",
      data: {"uid": uid},
      success:function(response){
        /*alert(response);*/
        var data = JSON.parse(response);
        $("#id_user").text(data.id_user);
        $("#name").text(data.nama);
        $("#tanggallahir").text(data.tanggallahir);
        $("#nohp").text(data.nohp);
        $("#alamat").text(data.alamat);

        var thelat = parseFloat(data.latitude);
        var thelong = parseFloat(data.longitude);

        console.log(thelat,thelong)

        // var dimana = {lat : thelat, lng : thelong};

        // var peta = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: dimana});
        // var marker = new google.maps.Marker({position:dimana, map: peta});

        var storage = firebase.app().storage("gs://lkptarq93.appspot.com/");

        var storageRef = storage.ref();

        var imagesRef = storageRef.child('Guru/IdentitasGuru');

        var fileName = uid;

        var penerimaRef = imagesRef.child(fileName);

        penerimaRef.getDownloadURL().then(function(url) {
          console.log(url)
          document.getElementById('picture').src = url;
        }).catch(function(error) {
                // Handle any errors
                console.log(error)
              });
              // return false;
            }
          });
    $("#accept").click(function() {
      /*alert('masokk pa eko!1');*/
      $.ajax({
        url: "p_accept_penerima.php",
        method: "GET",
        data: {"uid": uid},
        success:function(response){
          alert(response);
          location.reload(); 
        }
      });
    });
    $("#decline").click(function() {
      /*alert('masokk pa eko!1');*/
      $.ajax({
        url: "p_decline_penerima.php",
        method: "GET",
        data: {"uid": uid},
        success:function(response){
          alert(response);
          location.reload(); 
        }
      });
    })
  }

</script>

<?php include 'footer.php'; ?>