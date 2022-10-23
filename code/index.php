<?php
include("./controllers/db.php");
session_start();
if(!empty($_SESSION['employee_username1'])){
  $loggedinuseremail = $_SESSION['employee_username1'];
  $sql = "CALL select_logged_in_user_details('$loggedinuseremail')";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $name1 = $row['name1'];
  }
}
// echo "<script>console.log('".$loggedinuseremail."')</script>";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <section class="landing-page" id="landing-page">
      <?php
       if(empty($_SESSION['employee_username1'])){
        include("./not_logged_in_header.php");
       }
       else{
         include("./logged_in_header.php");
       }
      ?>
      <main>
        <section id="home" class="home">
          <div class="container">
            <div class="landing-image-container">
              <div class="landing-image">
                <div class="text">
                  <h1>Top Wrestling Figures all at one place.</h1>
                  <p>Add your favourite figures to your collections.</p>
                  <?php
                    if(empty($_SESSION['employee_username1'])){
                    ?>
                      <a class="btn btn-primary" href="./login.php">Log in</a>
                      <?php
                    }
                    else{
                      ?>
                      <a class="btn btn-primary" href="./products.php">Wrestling Figures</a>
                      <?php                      
                    }
                    ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="why-chose-us">
          <div class="container">
            <h3 class="section-heading text-center">Why Choose Us?</h3>
            <p class="text-center punch-line">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
              aliquam, purus sit amet luctus venenatis, lectus magna fringilla
              urna, porttitor
            </p>
            <div class="row g-xxl-4 g-3">
              <div class="col-md-4">
                <div class="box">
                  <div class="count">1</div>
                  <h5 class="title">Best Wrestling Toy Figures</h5>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
                    aliquam, purus sit amet luctus venenatis, lectus magna
                    fringilla urna, porttitor
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box">
                  <div class="count">2</div>
                  <h5 class="title">Create your Collections</h5>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
                    aliquam, purus sit amet luctus venenatis, lectus magna
                    fringilla urna, porttitor
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box">
                  <div class="count">3</div>
                  <h5 class="title">Wishlists</h5>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
                    aliquam, purus sit amet luctus venenatis, lectus magna
                    fringilla urna, porttitor
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="top-figures">
          <div class="container">
            <div class="text-center px-xxl-5 px-md-4">
              <h5 class="section-heading mb-4">Top Wrestling Figures</h5>
              <div class="row g-xxl-4 g-3">
                <div class="col-md-4">
                  <a href="" class="box ms-md-0 me-md-auto mx-auto">
                    <div class="box-img-container">
                      <img src="./assets/images/top_fig_1.jpg" alt="">
                    </div>
                    <div class="figure-name">
                      Sin Cara
                    </div>
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="" class="box text-center mx-auto">
                    <div class="box-img-container">
                      <img src="./assets/images/top_fig_2.jpg" alt="">
                    </div>
                    <div class="figure-name">
                      Rey Mysterio
                    </div>
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="" class="box ms-md-auto me-md-0 mx-auto">
                    <div class="box-img-container">
                      <img src="./assets/images/top_fig_2.jpg" alt="">
                    </div>
                    <div class="figure-name">
                      MVP
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
          if(empty($_SESSION['employee_username1'])){
          ?>
        <section class="join-us">
          <div class="container">
            <div class="text-center">
              <h4 class="section-heading mb-xxl-5 mb-3">Join Us Today for Free!</h4>
              <button class="btn btn-primary create-free-account">Create Free Account</button>
            </div>
          </div>
        </section>          
          <?php
          }
        ?>
      </main>
      <footer>
        <img src="./assets/images/logo.svg" width="316" class="img-fluid" alt="">
      </footer>
    </section>

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
