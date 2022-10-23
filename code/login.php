<?php
include("./controllers/db.php");
session_start();
if(!empty($_SESSION['employee_username1'])){
  echo "<script>window.location.replace('index.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <section class="landing-page" id="landing-page">
      <?php 
        include("./not_logged_in_header.php");
      ?>
      <main>
        <section id="signup-login-container" class="signup-login-container">
          <div class="container-fluid">
            <div class="row gx-xxl-5 gx-3">
              <div class="col-lg-7 order-lg-0 order-1">
                <div class="box-container login">
                  <div class="images">
                    <img
                      src="./assets/images/login_top.svg"
                      class="image-1"
                      alt=""
                    />
                    <div class="d-flex">
                      <img
                        src="./assets/images/login_lower_left.svg"
                        class="image-2 d-inline-flex"
                        alt=""
                      />
                      <img
                        src="./assets/images/login_lower_right.svg"
                        class="image-3 d-inline-flex"
                        alt=""
                      />
                    </div>
                  </div>
                  <div class="text">
                    <h1>Top Wrestling Figures all at one place.</h1>
                    <p>Add your favourite figures to your collections.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 order-lg-1 order-0">
                <div class="fields-container-outside">
                  <div class="fields-container-inside login">
                    <h5 class="heading">Log in.</h5>
                    <form id="loginform" class="needs-validation">
                      <div class="row">
                        <div class="col-12">
                          <label for="email" class="form-label"
                            >Email Address</label
                          >
                          <div class="form-group">
                            <input
                              type="email"
                              name="email1"
                              id="email"
                              class="form-control"
                            />
                          </div>
                        </div>
                        <div class="col-12">
                          <label for="password" class="form-label"
                            >Password</label
                          >
                          <div class="form-group">
                            <input
                              type="password"
                              name="pass1"
                              id="password"
                              class="form-control"
                            />
                          </div>
                        </div>
                        <div class="col-12 text-center">
                          <button class="btn btn-primary" type="submit">
                            Log in
                          </button>
                        </div>
                      </div>
                    </form>
                    <div class="text-center">
                      <p class="helper-text">
                        Don't have an account?
                        <a href="./registration.php" class="text-primary2 text-decoration-none"
                          >Create one for free.</a
                        >
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
      <footer>
        <img
          src="./assets/images/logo.svg"
          width="316"
          class="img-fluid"
          alt=""
        />
      </footer>
    </section>
    <div id="div11"></div>
    <div class="loading" id="loader1" style="visibility: hidden;">Loading&#8230;</div>
    <script>
    var request;

    $("#loginform").submit(function (event) {

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
        url: "controllers/logincall.php",
        success: function (result) {
          $("#div11").html(result);
          document.getElementById("loader1").style.visibility = "hidden";
        }
      });
    });
  </script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>

    <script>
      document.getElementById("humburger").onclick = function () {
        document.getElementById("my-nav").classList.toggle("d-block");
      };
    </script>
  </body>
</html>
