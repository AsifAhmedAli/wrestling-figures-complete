
<?php
include("./controllers/db.php");
session_start();
if(isset($_GET['filter'])){
  $sort = $_GET['filter'];
}
else{
  $sort = "none";
}

if(!empty($_SESSION['employee_username1'])){
  $loggedinuseremail = $_SESSION['employee_username1'];
  $sql = "CALL select_logged_in_user_details('$loggedinuseremail')";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $name1 = $row['name1'];
    $id = $row['id'];
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wishlists - Single</title>

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
            <h4 class="title">Your Wishlist</h4>
          </div>
          <div class="body">
            <div class="container-fluid">
              <div class="top">
                <h4 class="title">&nbsp;</h4>
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
                        Sort By</span
                      >
                      <span class="material-icons">arrow_drop_down</span>
                    </button>
                    <ul
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton1"
                    >
                      <li>
                        <a class="dropdown-item active" href="./singlewishlist.php?filter=brand">Brand</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="./singlewishlist.php?filter=series">Series</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="./singlewishlist.php?filter=year">Year</a>
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
                        <a
                          class="dropdown-item active"
                          href="./singlewishlist.php"
                          >Card View</a
                        >
                      </li>
                      <li>
                        <a class="dropdown-item" href="./mywishlists.php"
                          >Table View</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="collections-container">
                <div class="row g-xxl-4 gy-4">
                  <?php

                  switch ($sort) {
                    case 'none':{
                      $conn -> next_result();
                      $sql21 = "CALL wish_list_of_a_user_with_figure_details('$id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['id'];

                              $conn->next_result();
                              $sqlq1 = "CALL all_images_with_id_of_wrestler_thumbnail('$idofwrestlingfigure')";
                              $result1 = $conn->query($sqlq1);
                      
                              if ($result1->num_rows > 0) {
                              // output data of each row
                              while($row1 = $result1->fetch_assoc()) {
                              $thumbnail = $row1['thumbnail'];
                              $image_name = $row1['image_name'];            
                                  }
                              }
                              else{
                                  $thumbnail = 'no';
                              }
                                    ?>
                                                      <div class="col-lg-3 col-md-6">
                                                        <div class="collection-container single blue">
                                                          <a href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                          <?php
                                                                  if($thumbnail == 'yes'){
                                                                      $selected_image = $image_name;
                                                                      $selected_image1 = "../wrestler_images/".$image_name;
                                                                  }
                                                                  else{
                                                                      $selected_image = './assets/images/sin_cara.svg';
                                                                  }
                                                          ?>
                                                            <img src="<?php echo $selected_image; ?>" onerror="this.onerror=null; this.src='<?php echo $selected_image1; ?>'" alt=""/>
                                                            <div class="details">
                                                              <h4 class="title"><?php echo $row21['wrestler']; ?></h4>
                                                            </div>
                                                          </a>
                                                          <div class="actions">
                                                            <div class="dropdown">
                                                              <button class="btn" type="button"
                                                                id="dropdownMenuButton1"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="material-icons">more_horiz</span>
                                                              </button>
                                                              <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                <li>
                                                                  <button onclick="remove_from_wishlist_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>')"
                                                                    class="dropdown-item">Remove from
                                                                    Wishlist</button>
                                                                </li>
                                                              </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                    <?php
                            }
                          }
                      break;
                    }
                    case 'brand':{
                      $conn -> next_result();
                      $sql21 = "CALL wish_list_of_a_user_with_figure_details_order_by_brand('$id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['id'];

                              $conn->next_result();
                              $sqlq1 = "CALL all_images_with_id_of_wrestler_thumbnail('$idofwrestlingfigure')";
                              $result1 = $conn->query($sqlq1);
                      
                              if ($result1->num_rows > 0) {
                              // output data of each row
                              while($row1 = $result1->fetch_assoc()) {
                              $thumbnail = $row1['thumbnail'];
                              $image_name = $row1['image_name'];            
                                  }
                              }
                              else{
                                  $thumbnail = 'no';
                              }
                                    ?>
                                                      <div class="col-lg-3 col-md-6">
                                                        <div class="collection-container single blue">
                                                          <a href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                          <?php
                                                                  if($thumbnail == 'yes'){
                                                                      $selected_image = $image_name;
                                                                      $selected_image1 = "../wrestler_images/".$image_name;
                                                                  }
                                                                  else{
                                                                      $selected_image = './assets/images/sin_cara.svg';
                                                                  }
                                                          ?>
                                                            <img src="<?php echo $selected_image; ?>" onerror="this.onerror=null; this.src='<?php echo $selected_image1; ?>'" alt=""/>
                                                            <div class="details">
                                                              <h4 class="title"><?php echo $row21['wrestler']; ?></h4>
                                                            </div>
                                                          </a>
                                                          <div class="actions">
                                                            <div class="dropdown">
                                                              <button class="btn" type="button"
                                                                id="dropdownMenuButton1"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="material-icons">more_horiz</span>
                                                              </button>
                                                              <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                <li>
                                                                  <button onclick="remove_from_wishlist_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>')"
                                                                    class="dropdown-item">Remove from
                                                                    Wishlist</button>
                                                                </li>
                                                              </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                    <?php
                            }
                          }
                      break;
                    }
                    case 'series':{
                      $conn -> next_result();
                      $sql21 = "CALL wish_list_of_a_user_with_figure_details_order_by_series('$id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['id'];

                              $conn->next_result();
                              $sqlq1 = "CALL all_images_with_id_of_wrestler_thumbnail('$idofwrestlingfigure')";
                              $result1 = $conn->query($sqlq1);
                      
                              if ($result1->num_rows > 0) {
                              // output data of each row
                              while($row1 = $result1->fetch_assoc()) {
                              $thumbnail = $row1['thumbnail'];
                              $image_name = $row1['image_name'];            
                                  }
                              }
                              else{
                                  $thumbnail = 'no';
                              }
                                    ?>
                                                      <div class="col-lg-3 col-md-6">
                                                        <div class="collection-container single blue">
                                                          <a href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                          <?php
                                                                  if($thumbnail == 'yes'){
                                                                      $selected_image = $image_name;
                                                                      $selected_image1 = "../wrestler_images/".$image_name;
                                                                  }
                                                                  else{
                                                                      $selected_image = './assets/images/sin_cara.svg';
                                                                  }
                                                          ?>
                                                            <img src="<?php echo $selected_image; ?>" onerror="this.onerror=null; this.src='<?php echo $selected_image1; ?>'" alt=""/>
                                                            <div class="details">
                                                              <h4 class="title"><?php echo $row21['wrestler']; ?></h4>
                                                            </div>
                                                          </a>
                                                          <div class="actions">
                                                            <div class="dropdown">
                                                              <button class="btn" type="button"
                                                                id="dropdownMenuButton1"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="material-icons">more_horiz</span>
                                                              </button>
                                                              <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                <li>
                                                                  <button onclick="remove_from_wishlist_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>')"
                                                                    class="dropdown-item">Remove from
                                                                    Wishlist</button>
                                                                </li>
                                                              </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                    <?php
                            }
                          }
                      break;
                    }
                    case 'year':{
                      $conn -> next_result();
                      $sql21 = "CALL wish_list_of_a_user_with_figure_details_order_by_year('$id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['id'];

                              $conn->next_result();
                              $sqlq1 = "CALL all_images_with_id_of_wrestler_thumbnail('$idofwrestlingfigure')";
                              $result1 = $conn->query($sqlq1);
                      
                              if ($result1->num_rows > 0) {
                              // output data of each row
                              while($row1 = $result1->fetch_assoc()) {
                              $thumbnail = $row1['thumbnail'];
                              $image_name = $row1['image_name'];            
                                  }
                              }
                              else{
                                  $thumbnail = 'no';
                              }
                                    ?>
                                                      <div class="col-lg-3 col-md-6">
                                                        <div class="collection-container single blue">
                                                          <a href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                          <?php
                                                                  if($thumbnail == 'yes'){
                                                                      $selected_image = $image_name;
                                                                      $selected_image1 = "../wrestler_images/".$image_name;
                                                                  }
                                                                  else{
                                                                      $selected_image = './assets/images/sin_cara.svg';
                                                                  }
                                                          ?>
                                                            <img src="<?php echo $selected_image; ?>" onerror="this.onerror=null; this.src='<?php echo $selected_image1; ?>'" alt=""/>
                                                            <div class="details">
                                                              <h4 class="title"><?php echo $row21['wrestler']; ?></h4>
                                                            </div>
                                                          </a>
                                                          <div class="actions">
                                                            <div class="dropdown">
                                                              <button class="btn" type="button"
                                                                id="dropdownMenuButton1"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="material-icons">more_horiz</span>
                                                              </button>
                                                              <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                <li>
                                                                  <button onclick="remove_from_wishlist_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>')"
                                                                    class="dropdown-item">Remove from
                                                                    Wishlist</button>
                                                                </li>
                                                              </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                    <?php
                            }
                          }
                      break;
                    }
                    default:
                      # code...
                      break;
                  }
                  ?>

                  
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
<div id="div122"></div>
<div class="loading" id="loader1" style="visibility: hidden;">Loading&#8230;</div>
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


      function remove_from_wishlist_employee(user_id, figure_id){
      // console.log(x);
      document.getElementById('loader1').style.visibility = 'visible';
      $.ajax({
                type: "post",
                data: {user_id:user_id,figure_id:figure_id},
                url: "./controllers/remove_from_wishlist_controller.php",
                success: function (result) {
                  $('#mymodal').modal('hide');
                    $("#div122").html(result);
                    document.getElementById('loader1').style.visibility = 'hidden';
                }
            });
    }
    
    </script>
</body>
</html>
