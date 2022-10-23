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
    <title>Products Item</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/OwlCarousel/css/owl.carousel.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
      rel="stylesheet"
      href="./assets/OwlCarousel/css/owl.theme.default.css"
    />
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
        <section class="products">
          <h4 class="heading">Search your favourite Wrestling Figure.</h4>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-8 col-12 mx-auto">
                <div class="search-fig-container">
                  <form action="">
                    <div
                      class="row align-items-center justify-content-center gy-3"
                    >
                      <div class="col">
                        <select name="" id="" class="form-select">
                          <option value="" selected>Brand</option>
                        </select>
                      </div>
                      <div class="col">
                        <select name="" id="" class="form-select">
                          <option value="" selected>Series</option>
                        </select>
                      </div>
                      <div class="col">
                        <select name="" id="" class="form-select">
                          <option value="" selected>Year</option>
                        </select>
                      </div>
                      <div class="col">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Wrestler Name"
                        />
                      </div>
                      <div class="col">
                        <button type="submit">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-lg-7">
                <div class="carousel">
                  <ul class="carousel__list">
                    <li class="carousel__item" data-pos="-2">1</li>
                    <li class="carousel__item" data-pos="-1">2</li>
                    <li class="carousel__item" data-pos="0">3</li>
                    <li class="carousel__item" data-pos="1">4</li>
                    <li class="carousel__item" data-pos="2">5</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="product-specs-outer">
                  <div class="product-specs-inner">
                    <h4 class="product-title">Sin Cara</h4>
                    <h5 class="product-tier">Elite 25</h5>
                    <div class="product-actions">
                      <button class="like">
                        <span class="material-icons material-icons-outlined"
                          >thumb_up</span
                        >
                      </button>
                      <button class="dislike">
                        <span class="material-icons material-icons-outlined"
                          >thumb_down</span
                        >
                      </button>
                    </div>
                    <table class="table">
                      <tr>
                        <th>Brand</th>
                        <td>Mattel</td>
                      </tr>
                      <tr>
                        <th>Line</th>
                        <td>Elite</td>
                      </tr>
                      <tr>
                        <th>Subline</th>
                        <td>Elites</td>
                      </tr>
                      <tr>
                        <th>Series</th>
                        <td>25</td>
                      </tr>
                      <tr>
                        <th>Year</th>
                        <td>2013</td>
                      </tr>
                    </table>
                    <button class="btn btn-primary action">
                      <img src="./assets/images/gift_white.svg" alt="" />
                      Add to Wishlist
                    </button>
                    <button
                      class="btn btn-primary action"
                      data-bs-toggle="modal"
                      data-bs-target="#addtowishlist"
                    >
                      <img src="./assets/images/add_to_collection.svg" alt="" />
                      Add to Collection
                    </button>
                    <button class="btn btn-secondary disabled action">
                      <img src="./assets/images/remove.svg" alt="" />
                      Remove
                    </button>
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

    <!-- Modal -->
    <div
      class="modal fade"
      id="addtowishlist"
      tabindex="-1"
      aria-labelledby="addtowishlistLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content bg-darkblue">
          <div class="modal-header">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <h4 class="title">Collections</h4>
            </div>
            <form action="" class="mb-lg-4 mb-3 needs-validation">
              <div class="row gy-3">
                <div class="col-12">
                  <label for="" class="form-label">Add to Collection:</label>
                  <div class="form-group">
                    <select name="" id="" class="form-select text-primary2">
                      <option value="" selected>Choose from the list</option>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <div class="text-end">
                    <button class="btn btn-primary">Add</button>
                  </div>
                </div>
              </div>
            </form>
            <form action="" class="mb-lg-4 mb-3 needs-validation">
              <div class="row gy-3">
                <div class="col-12">
                  <label for="" class="form-label"
                    >Create New Collection:</label
                  >
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control text-primary2"
                      placeholder="Add Name"
                    />
                  </div>
                </div>
                <div class="col-12">
                  <div class="text-end">
                    <button class="btn btn-primary">Create</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.1.min.js"
      integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
      crossorigin="anonymous"
    ></script>
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
    <script src="./assets/OwlCarousel/js/owl.carousel.js"></script>
    <script>
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 1,
          },
          1000: {
            items: 1,
          },
        },
      });
    </script>
    <script>
      $(document).ready(function () {
        $(".owl-item.active").next().addClass("transformLeft");
        $(".owl-item.active").prev().addClass("transformRight");

        $(".owl-next").click(function () {
          $(".owl-item").removeClass("transformLeft");
          $(".owl-item").removeClass("transformRight");
          $(".owl-item.active").next().addClass("transformLeft");
          $(".owl-item.active").prev().addClass("transformRight");
        });
      });
    </script>

    <script>
      document.getElementById("humburger").onclick = function () {
        document.getElementById("my-nav").classList.toggle("d-block");
      };
    </script>
    
    <script>
      
    </script>
  </body>
</html>
