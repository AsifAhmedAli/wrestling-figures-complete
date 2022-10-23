<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wishlists</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <section class="user-page" id="user-page">
      <header>
        <nav>
          <a href="" class="logo">
            <img
              src="./assets/images/logo.svg"
              width="158"
              height="38"
              alt=""
              class="logo-img"
            />
          </a>
          <button class="humburger" id="humburger"></button>
          <ul id="my-nav">
            <li class="logo">
              <a href="" class="logo">
                <img
                  src="./assets/images/logo.svg"
                  width="158"
                  height="38"
                  alt=""
                  class="logo-img"
                />
              </a>
            </li>
            <li>
              <a href="./products.php" class="nav-link">Wrestling Figures</a>
            </li>
            <li>
              <a href="./wishlist.php" class="nav-link active">Wishlist</a>
            </li>
            <li>
              <a href="./collections.php" class="nav-link"
                >Collections</a
              >
            </li>
            <li>
              <div class="divider"></div>
            </li>
            <li>
              <div class="dropdown">
                <button
                  class="nav-link"
                  type="button"
                  id="dropdownMenuButton1"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <span
                    class="material-icons material-icons-outlined me-md-2 me-1"
                    >account_circle</span
                  >
                  Josh Dallas
                  <span
                    class="material-icons material-icons-outlined ms-md-2 ms-1"
                    >expand_more</span
                  >
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </header>
      <main>
        <section class="collections">
          <div class="header">
            <img src="./assets/images/wishlist_bg.svg" alt="" />
            <div class="overlay"></div>
            <h4 class="title">Your Wishlists</h4>
          </div>
          <div class="body">
            <div class="container-fluid">
              <div class="top">
                <h4 class="title">Wish Lists:</h4>
                <div class="filters"></div>
              </div>
              <div class="collections-container">
                <div class="row g-xxl-4 gy-3">
                  <div class="col-xl-3 col-md-6">
                    <div class="collection-container red">
                      <a href="./singlewishlist.php">
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
                  <div class="col-xl-3 col-md-6">
                    <div class="collection-container yellow">
                      <a href="./singlewishlist.php">
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
                  <div class="col-xl-3 col-md-6">
                    <div class="collection-container blue">
                      <a href="./singlewishlist.php">
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
                  <div class="col-xl-3 col-md-6">
                    <div class="collection-container red">
                      <a href="./singlewishlist.php">
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
