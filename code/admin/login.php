<?php
include("../controllers/db.php");
session_start();
  if(!empty($_SESSION['admin_username'])){
        echo "<script>window.location.replace('index.php');</script>";
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Wrestling Figures</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <style>.btn.btn-primary.btn-block.text-white.btn-user:focus{
        box-shadow: none;
    }
    </style>
</head>

<body style="background-color: #fff !important;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5" style="background-color: #271a34;">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="p-5">
                                <?php
                                // $sql = "SELECT logofilename FROM logo";
                                // $result = $conn->query($sql);

                                // if ($result->num_rows > 0) {
                                // // output data of each row
                                // while($row = $result->fetch_assoc()) {
                                //     $logoname = $row['logofilename'];
                                // }
                                // }
                                // $logoname = "logo_folder/".$logoname;
                                // // echo $logoname;
                                // ?>
                                    <div class="text-center mb-4"><img src="../assets/images/logo.svg" style="max-width: 140px;"></div>
                                    <form class="user" id="adminloginform">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email..." name="email1"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password"></div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div><button class="btn btn-primary btn-block text-white btn-user" style="background-color: rgb(40 54 90);border: 1px solid rgb(40 54 90);" type="submit">Login</button>
                                    </form>
                                    <div class="text-center"><a class="small">Forgot Password?</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="div11"></div>
    <div class="loading" id="loader1" style="visibility: hidden;">Loading&#8230;</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script>
    var request;

        $("#adminloginform").submit(function (event) {

            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);

            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");

            // Serialize the data in the form
            var serializedData = $form.serialize();
            document.getElementById("loader1").style.visibility = "visible";
            $.ajax({
                type: "post",
                data: serializedData,
                url: "adminlogincall.php",
                success: function (result) {
                    $("#div11").html(result);
                    document.getElementById("loader1").style.visibility = "hidden";
                }
            });
        });
    </script>
</body>

</html>