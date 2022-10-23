<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration</title>

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
          <div class="row gx-xxl-5 gx-3 gy-3">
            <div class="col-lg-7 order-lg-0 order-1">
              <div class="box-container">
                <div class="images">
                  <img src="./assets/images/login_top.svg" class="image-1" alt="" />
                  <div class="d-flex">
                    <img src="./assets/images/login_lower_left.svg" class="image-2 d-inline-flex" alt="" />
                    <img src="./assets/images/login_lower_right.svg" class="image-3 d-inline-flex" alt="" />
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
                <div class="fields-container-inside">
                  <h5 class="heading">Create Account</h5>
                  <form id="registrationform" class="needs-validation">
                    <div class="row">
                      <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <div class="form-group">
                          <input required type="text" id="name" class="form-control" name="name1" />
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="form-group">
                          <input required type="email" id="email" class="form-control" name="email1" />
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="form-group">
                          <input required type="password" id="password" class="form-control"
                            name="pass1" />
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check mb-1">
                          <input class="form-check-input" type="checkbox" id="flexCheckDefault" required />
                          <label class="form-check-label form-label" for="flexCheckDefault">
                            I accept the
                            <a href="" class="text-primary2 text-decoration-none">Terms and Conditions.</a>
                          </label>
                        </div>
                      </div>
                      <div class="col-12 text-center">
                        <button class="btn btn-primary" type="submit">
                          Sign Up
                        </button>
                      </div>
                    </div>
                  </form>
                  <div class="text-center">
                    <p class="helper-text">
                      Already have an account?
                      <a href="./login.php" class="text-primary2 text-decoration-none">Log in to your account.</a>
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
      <img src="./assets/images/logo.svg" width="316" class="img-fluid" alt="" />
    </footer>
  </section>
  <div class="loading" id="loader1" style="visibility: hidden;">Loading&#8230;</div>
  <div id="div11"></div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
  </script>
  <script>
    var request;

    $("#registrationform").submit(function (event) {

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
      document.getElementById("loader1").style.visibility = "visible";
      // Serialize the data in the form
      var serializedData = $form.serialize();
      $.ajax({
        type: "post",
        data: serializedData,
        url: "controllers/register_user.php",
        success: function (result) {
          $("#div11").html(result);
          document.getElementById("loader1").style.visibility = "hidden";
        }
      });
    });
  </script>
  <script>
    document.getElementById("humburger").onclick = function () {
      document.getElementById("my-nav").classList.toggle("d-block");
    };
  </script>
</body>

</html>