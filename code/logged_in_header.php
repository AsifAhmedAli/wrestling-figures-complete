<header>
        <nav>
          <a href="index.php" class="logo">
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
              <a href="./products.php" class="nav-link active"
                >Wrestling Figures</a
              >
            </li>
            <li>
              <a href="./singlewishlist.php" class="nav-link">Wishlist</a>
            </li>
            <li>
              <a href="./all_collections.php" class="nav-link">Collections</a>
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
                  <?php echo $name1; ?>
                  <span
                    class="material-icons material-icons-outlined ms-md-2 ms-1"
                    >expand_more</span
                  >
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="./controllers/logout.php">Logout</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </header>