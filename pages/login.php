<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tar Q - Mengaji</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>


</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                         <form>
                            <div class="form-group">
                              <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                              </div>
                            </div>
                            <a class="btn btn-primary btn-block" onclick="login();">Login</a>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div align="center" class="lds-css ng-scope" id="load" style="display: none;"><div style="width:100%;height:100%" class="lds-double-ring"><div></div><div></div></div><style type="text/css">@keyframes lds-double-ring {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes lds-double-ring {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes lds-double-ring_reverse {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
@-webkit-keyframes lds-double-ring_reverse {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
  }
}
.lds-double-ring {
  position: relative;
}
.lds-double-ring div {
  position: absolute;
  width: 160px;
  height: 160px;
  top: 20px;
  left: 20px;
  border-radius: 50%;
  border: 8px solid #000;
  border-color: #28292f transparent #28292f transparent;
  -webkit-animation: lds-double-ring 1s linear infinite;
  animation: lds-double-ring 1s linear infinite;
}
.lds-double-ring div:nth-child(2) {
  width: 140px;
  height: 140px;
  top: 30px;
  left: 30px;
  border-color: transparent #0a0a0a transparent #0a0a0a;
  -webkit-animation: lds-double-ring_reverse 1s linear infinite;
  animation: lds-double-ring_reverse 1s linear infinite;
}
.lds-double-ring {
  width: 200px !important;
  height: 200px !important;
  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
}
</style></div>

    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../js/login.js"></script>
    <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
