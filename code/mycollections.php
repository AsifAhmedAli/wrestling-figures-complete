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
    <title>Collection Name</title>

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
            <h4 class="title">Collection Name</h4>
          </div>
          <div class="body">
            <div class="container-fluid">
              <div class="top">
                <h4 class="title">Elite 25:</h4>
                <div class="filters">
                  <div class="dropdown me-lg-4 me-3">
                    <button
                      class="btn btn-outline-primary2"
                      type="button"
                      id="dropdownMenuButton1"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <span class="d-flex align-items-center"
                        ><span class="material-icons material-icons-outlined"
                          >filter_alt</span
                        >
                        Filter By</span
                      >
                      <span class="material-icons">arrow_drop_down</span>
                    </button>
                    <ul
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton1"
                    >
                      <li>
                        <a class="dropdown-item active" href="#">Brand</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#">Series</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#">Year</a>
                      </li>
                    </ul>
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn btn-outline-primary2"
                      type="button"
                      id="dropdownMenuButton1"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <span class="d-flex align-items-center"
                        ><span class="material-icons material-icons-outlined"
                          >view_quilt</span
                        >
                        View</span
                      >
                      <span class="material-icons">arrow_drop_down</span>
                    </button>
                    <ul
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton1"
                    >
                      <li>
                        <a class="dropdown-item" href="./singlecollection.php"
                          >Card View</a
                        >
                      </li>
                      <li>
                        <a
                          class="dropdown-item active"
                          href="./mycollections.php"
                          >Table View</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div
                class="list-collection table-responsive rounded bg-darkblue py-3 px-1"
              >
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Wrestler Name</th>
                      <th scope="col">Brand</th>
                      <th scope="col">Series</th>
                      <th scope="col">Year</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Elite Wrestler</td>
                      <td>Mattel</td>
                      <td>Elite 25</td>
                      <td>2013</td>
                      <td>
                        <a href="">Move to Other Wishlist</a>
                        <a href="">Delete</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Sin Cara</td>
                      <td>Mattel</td>
                      <td>Elite 25</td>
                      <td>2013</td>
                      <td>
                        <a href="">Move to Other Wishlist</a>
                        <a href="">Delete</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Ray Mysterio</td>
                      <td>Mattel</td>
                      <td>Elite 25</td>
                      <td>2013</td>
                      <td>
                        <a href="">Move to Other Wishlist</a>
                        <a href="">Delete</a>
                      </td>
                    </tr>
                    <tr>
                      <td>MVP</td>
                      <td>Mattel</td>
                      <td>Elite 25</td>
                      <td>2013</td>
                      <td>
                        <a href="">Move to Other Wishlist</a>
                        <a href="">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
