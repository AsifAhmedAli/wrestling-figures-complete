<?php
// program to tell php version using ftp/sftp client
//  phpinfo();

include("../controllers/db.php");
session_start();
  // if(empty($_SESSION['admin_username'])){
  //       echo "<script>window.location.replace('login.php');</script>";
  // }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <style>
        .nav-item:hover{
            cursor:pointer;
        }
        .asdfas:hover{
            cursor:pointer;
        }
        /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
.files input {
  outline: 2px dashed #92b0b3;
  outline-offset: -10px;
  -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
  transition: outline-offset .15s ease-in-out, background-color .15s linear;
  padding: 120px 0px 85px 35%;
  text-align: center !important;
  margin: 0;
  width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
  -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
  transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
}
.files{ position:relative}
.files:after {  pointer-events: none;
  position: absolute;
  top: 60px;
  left: 0;
  width: 50px;
  right: 0;
  height: 56px;
  content: "";
  background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
  display: block;
  margin: 0 auto;
  background-size: 100%;
  background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
  position: absolute;
  bottom: 10px;
  left: 0;  pointer-events: none;
  width: 100%;
  right: 0;
  height: 57px;
  content: " or drag it here. ";
  display: block;
  margin: 0 auto;
  color: #2ea591;
  font-weight: 600;
  text-transform: capitalize;
  text-align: center;
}
/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background-color: rgb(40 54 90) !important;background-image: none  !important;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-text mx-3"><span>Admin Panel</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" onclick="ajax_call_add_wrestling_figure()"><a class="nav-link" ><i class="far fa-user-circle"></i><span>Add Wrestling Figure</span></a></li>
                    <li class="nav-item" onclick="ajax_call_show_all_wrestling_figures()"><a class="nav-link" ><i class="far fa-user-circle"></i><span>All Wrestling Figures</span></a></li>
                    <li class="nav-item" onclick="ajax_call_all_users()"><a class="nav-link" ><i class="far fa-user-circle"></i><span>All Users</span></a></li>
                    <!--<li class="nav-item" onclick="ajax_call_edit_reasons()"><a class="nav-link" ><i class="far fa-user-circle"></i><span>Edit Reasons for Visit</span></a></li>
                    <li class="nav-item" onclick="ajax_call_view_appointments()"><a class="nav-link" ><i class="far fa-user-circle"></i><span>View all Appointments</span></a></li> -->
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="background-color: #271a34 !important;">
                    <div class="container-fluid">
                        <div class="ml-auto d-none d-sm-block">
                            <img src="../assets/images/logo.svg" style="max-width: 80px;">
                        </div>
                        <ul class="navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php //echo $_SESSION['username']; ?></span><img class="border rounded-circle img-profile" src="../assets/images/logo.svg"></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mt-3">
                            <a class="dropdown-item" href="logout.php" style="color: white;"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div id="showhere">
                    <div class="row">
                        <div class="col">
                            <!-- <h3 class="text-center">
                                Current Cash In Hand
                            </h3> -->
                            <h4 class="text-center">
                                
                            </h4>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Mexit.it</span></div>
                </div>
            </footer>
            <div class="loading" id="loader1" style="visibility: hidden;">Loading&#8230;</div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script>
        function ajax_call_add_wrestling_figure(){
                    document.getElementById("loader1").style.visibility = "visible";
                $.ajax({
                type: "post",
                url: "./backend/add_wrestling_figure.php",
                success: function (result) {
                    $("#showhere").html(result);
                    document.getElementById("loader1").style.visibility = "hidden";
                }
            });
        }
        function ajax_call_show_all_wrestling_figures(){
          document.getElementById("loader1").style.visibility = "visible";
                $.ajax({
                type: "post",
                url: "./backend/all_wrestling_figures.php",
                success: function (result) {
                    $("#showhere").html(result);
                    document.getElementById("loader1").style.visibility = "hidden";
                }
            });
        }
        function ajax_call_all_users(){
          document.getElementById("loader1").style.visibility = "visible";
                $.ajax({
                type: "post",
                url: "./backend/all_users.php",
                success: function (result) {
                    $("#showhere").html(result);
                    document.getElementById("loader1").style.visibility = "hidden";
                }
            });

        }
        // function ajax_call_update_address_details(){
        //         $.ajax({
        //         type: "post",
        //         url: "edit-contact.php",
        //         success: function (result) {
        //             $("#showhere").html(result);
        //         }
        //     });
        // }
        //         function ajax_call_view_appointments(){
        //         $.ajax({
        //         type: "post",
        //         url: "view-employee.php",
        //         success: function (result) {
        //             $("#showhere").html(result);
        //         }
        //     });
        // }
        // function ajax_call_edit_reasons(){
        //     // var x1 = "x1";
        //     document.getElementById("loader1").style.visibility = "visible";
        //     $.ajax({
        //     type: "post",
        //     // data:{x1:x1},
        //     url: "edit_reasons.php",
        //     success: function(result){
        //         $("#showhere").html(result);
        //         document.getElementById("loader1").style.visibility = "hidden";
        //     }
        // }); 
        // }
    </script>
</body>

</html>