<?php
session_start();
include 'header.php'; 
include '../database/database_guru.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Verifikasi Guru</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Antrian Guru Menunggu Persetujuan
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
                      <td><?php echo $val['nama']; ?></td>
                      <td><?php echo $val['nohp']; ?></td>
                      <td id="createdAt">
                        <?php
                        $createdAt = $user->metadata->createdAt;
                        echo $createdAt->format('d / M / Y');
                        ?>
                      </td>
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

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Detail Calon Guru</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped">
          <tr>
            <td colspan="2" class="text-center"><b>BIODATA</b></td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <img src="https://image.flaticon.com/icons/svg/149/149071.svg" id="picture" width="20%" height="20%"></img>
            </td>
          </tr>
          <tr>
            <td class="text-center" style="width: 10%;"><b>ID</b></i></td>
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
            <td class="text-center"><b><i class="fa fa-calendar"></i></b></td>
            <td><span id="tanggallahir"></span></td>
          </tr>
          <tr>
            <td class="text-center"><i class="fa fa-map-marker"></i></td>
            <td><span id="alamat"></span></td>
          </tr>
          <tr>
            <td class="text-center" colspan="2"><a href="" target="_blank" id="googlemaps" class="btn btn-primary">Google Maps</a></td>
          </tr>
        </table>
        <table class="table table-bordered table-striped">
          <tr>
            <td align="center" colspan="3"><b>KEAHLIAN</b></td>
          </tr>
          <tr>
            <td align="center" style="width: 33.33%;">Pra Tahsin 1</td>
            <td align="center" style="width: 33.33%;">Pra Tahsin 2</td>
            <td align="center" style="width: 33.33%;">Pra Tahsin 3</td>
          </tr>
          <tr>
            <td align="center"><i id="pratahsin1" class="fa"></i></td>
            <td align="center"><i id="pratahsin2" class="fa"></i></td>
            <td align="center"><i id="pratahsin3" class="fa"></i></td>
          </tr>
          <tr>
            <td align="center" style="width: 33.33%;">Tahsin 1</td>
            <td align="center" style="width: 33.33%;">Tahsin 2</td>
            <td align="center" style="width: 33.33%;">Tahsin 3</td>
          </tr>
          <tr>
            <td align="center"><i id="tahsin1" class="fa"></i></td>
            <td align="center"><i id="tahsin2" class="fa"></i></td>
            <td align="center"><i id="tahsin3" class="fa"></i></td>
          </tr>
          <tr>
            <td align="center" style="width: 33.33%;">Tahsin 4</td>
            <td align="center" style="width: 33.33%;">Tahfizh</td>
            <td align="center" style="width: 33.33%;">Bahasa Arab</td>
          </tr>
          <tr>
            <td align="center"><i id="tahsin4" class="fa"></i></td>
            <td align="center"><i id="tahfizh" class="fa"></i></td>
            <td align="center"><i id="bahasaarab" class="fa"></i></td>
          </tr>
        </table>
        <table class="table table-striped table-bordered">
          <tr>
            <td align="center"><b>LAMPIRAN</b></td>
          </tr>
          <tr>
            <td align="center">
              <img src="" width="30%" height="30%" alt="sertifikat" id="serti">
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" href="#" id="decline">Decline</button>
        <button class="btn btn-success" type="button" href="#" id="accept">Accept</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">

  function showDetails(button){
    var uid = button.id;
    console.log(uid);
    $.ajax({
      url: "../func/f_detail_antrian_guru.php",
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

        var pratahsin1 = data.pratahsin1;
        var pr1 = document.getElementById("pratahsin1");
        if (pratahsin1 == "true") {
          pr1.classList.add("fa-check");
        }else{
          pr1.classList.add("fa-times");
        }
        var pratahsin2 = data.pratahsin2;
        var pr2 = document.getElementById("pratahsin2");
        if (pratahsin2 == "true") {
          pr2.classList.add("fa-check");
        }else{
          pr2.classList.add("fa-times");
        }
        var pratahsin3 = data.pratahsin3;
        var pr3 = document.getElementById("pratahsin3");
        if (pratahsin3 == "true") {
          pr3.classList.add("fa-check");
        }else{
          pr3.classList.add("fa-times");
        }

        var tahsin1 = data.tahsin1;
        var t1 = document.getElementById("tahsin1");
        if (tahsin1 == "true") {
          t1.classList.add("fa-check");
        }else{
          t1.classList.add("fa-times");
        }
        var tahsin2 = data.tahsin2;
        var t2 = document.getElementById("tahsin2");
        if (tahsin2 == "true") {
          t2.classList.add("fa-check");
        }else{
          t2.classList.add("fa-times");
        }
        var tahsin3 = data.tahsin3;
        var t3 = document.getElementById("tahsin3");
        if (tahsin3 == "true") {
          t3.classList.add("fa-check");
        }else{
          t3.classList.add("fa-times");
        }
        var tahsin4 = data.tahsin4;
        var t4 = document.getElementById("tahsin4");
        if (tahsin4 == "true") {
          t4.classList.add("fa-check");
        }else{
          t4.classList.add("fa-times");
        }

        var tahfizh = data.tahfizh;
        var t = document.getElementById("tahfizh");
        if (tahfizh == "true") {
          t.classList.add("fa-check");
        }else{
          t.classList.add("fa-times");
        }
        var bahasaarab = data.bahasaarab;
        var b = document.getElementById("bahasaarab");
        if (bahasaarab == "true") {
          b.classList.add("fa-check");
        }else{
          b.classList.add("fa-times");
        }

        var thelat = parseFloat(data.latitude);
        var thelong = parseFloat(data.longitude);

        var googlemapsURL = "https://www.google.com/maps/place/"+thelat+","+thelong;
        document.getElementById('googlemaps').href = googlemapsURL;

        var storage = firebase.app().storage("gs://lkptarq93.appspot.com/");
        var storageRef = storage.ref();
        var fileName = uid;

        var imagesRef = storageRef.child('Guru/IdentitasGuru');
        var penerimaRef = imagesRef.child(fileName);
        penerimaRef.getDownloadURL().then(function(url) {
          document.getElementById('picture').src = url;
        })
        .catch(function(error) {
          document.getElementById('picture').src = "https://image.flaticon.com/icons/svg/149/149071.svg";
        });

        var sertiRef = storageRef.child('Guru/SIM');
        var newsertiRef = sertiRef.child(fileName);
        newsertiRef.getDownloadURL().then(function(url) {
          document.getElementById('serti').src = url;
          console.log(url)
        })
        .catch(function(error) {
          document.getElementById('serti').src = "https://banner2.kisspng.com/20180412/etq/kisspng-question-mark-clip-art-question-mark-5acfe76ea62476.5893581115235746386805.jpg";
          console.log(error);
        });
      }
    });
    $("#accept").click(function() {
      $.ajax({
        url: "../func/f_accept_guru.php",
        method: "GET",
        data: {"uid": uid},
        success:function(response){
          alert(response);
          location.reload(); 
        }
      });
    });
    $("#decline").click(function() {
      $.ajax({
        url: "../func/f_decline_guru.php",
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