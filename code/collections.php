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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Collections</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <section class="user-page" id="user-page">
    <?php
       if(empty($_SESSION['employee_username1'])){
        include("./not_logged_in_header.php");
       }
       else{
         include("./logged_in_header.php");
       }
      ?>
      <main>
        <section class="collections">
          <div class="header">
            <img src="./assets/images/wishlist_bg.svg" alt="" />
            <div class="overlay"></div>
            <h4 class="title">Your Collections</h4>
          </div>
          <div class="body">
            <div class="container-fluid">
              <div class="top">
                <h4 class="title">Collections:</h4>
                <div class="filters"></div>
              </div>
              <div class="collections-container">
                <div class="row g-xxl-4 gy-4">
                  <div class="col-lg-3 col-md-6">
                    <div class="collection-container red">
                      <a href="./singlecollection.php">
                        <img src="./assets/images/jeff_hardy.svg" alt="" />
                        <div class="details">
                          <h4 class="title">Elite 25</h4>
                          <div class="collection-number">5</div>
                        </div>
                      </a>
                      <div class="actions">
                        <div class="dropdown">
                          <button
                            class="btn"
                            type="button"
                            id="dropdownMenuButton1"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <span class="material-icons">more_horiz</span>
                          </button>
                          <ul
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton1"
                          >
                            <li>
                              <a class="dropdown-item" href="#">Rename</a>
                            </li>
                            <li>
                              <a href="" class="dropdown-item">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="collection-container yellow">
                      <a href="./singlecollection.php">
                        <img src="./assets/images/edge.svg" alt="" />
                        <div class="details">
                          <h4 class="title">Elite 25</h4>
                          <div class="collection-number">5</div>
                        </div>
                      </a>
                      <div class="actions">
                        <div class="dropdown">
                          <button
                            class="btn"
                            type="button"
                            id="dropdownMenuButton1"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <span class="material-icons">more_horiz</span>
                          </button>
                          <ul
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton1"
                          >
                            <li>
                              <a class="dropdown-item" href="#">Rename</a>
                            </li>
                            <li>
                              <a href="" class="dropdown-item">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="collection-container blue">
                      <a href="./singlecollection.php">
                        <img src="./assets/images/batman.jpg" alt="" />
                        <div class="details">
                          <h4 class="title">Elite 25</h4>
                          <div class="collection-number">5</div>
                        </div>
                      </a>
                      <div class="actions">
                        <div class="dropdown">
                          <button
                            class="btn"
                            type="button"
                            id="dropdownMenuButton1"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <span class="material-icons">more_horiz</span>
                          </button>
                          <ul
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton1"
                          >
                            <li>
                              <a class="dropdown-item" href="#">Rename</a>
                            </li>
                            <li>
                              <a href="" class="dropdown-item">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="collection-container red">
                      <a href="./singlecollection.php">
                        <img src="./assets/images/big_show.svg" alt="" />
                        <div class="details">
                          <h4 class="title">Elite 25</h4>
                          <div class="collection-number">5</div>
                        </div>
                      </a>
                      <div class="actions">
                        <div class="dropdown">
                          <button
                            class="btn"
                            type="button"
                            id="dropdownMenuButton1"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <span class="material-icons">more_horiz</span>
                          </button>
                          <ul
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton1"
                          >
                            <li>
                              <a class="dropdown-item" href="#">Rename</a>
                            </li>
                            <li>
                              <a href="" class="dropdown-item">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
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
