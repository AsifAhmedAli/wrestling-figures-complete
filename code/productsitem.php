
<?php
include("./controllers/db.php");
session_start();
$product_id = $_GET['id'];
$images_array = [];
$sql = "CALL get_product_details('$product_id')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
   while($row = $result->fetch_assoc()){
   $date_created = $row['date_created'];
   $wrestler = $row['wrestler'];
   $SKU = $row['SKU'];
   $Brand = $row['Brand'];
   $line = $row['line'];
   $subline = $row['subline'];
   $year = $row['year'];
   $series = $row['series'];
   array_push($images_array,$row['image_name']);
  }
}
else{
  $conn->next_result();
  $sql = "CALL figure_details_with_image('$product_id')";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
     while($row = $result->fetch_assoc()){
     $date_created = $row['date_created'];
     $wrestler = $row['wrestler'];
     $SKU = $row['SKU'];
     $Brand = $row['Brand'];
     $line = $row['line'];
     $subline = $row['subline'];
     $year = $row['year'];
     $series = $row['series'];
    //  array_push($images_array,$row['image_name']);
    }
  }
}


if(!empty($_SESSION['employee_username1'])){
  $conn->next_result();
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
    <title><?php echo $wrestler; ?></title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/vanilla-js-carousel-master/carousel.css">
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
      //  print_r($images_array);
      ?>
      <main>
        <section class="products">
          <!-- <h4 class="heading">Search your favourite Wrestling Figure.</h4> -->
          <div class="container-fluid">
            <!-- <div class="row">
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
            </div> -->
            <div class="row align-items-center">
              <div class="col-lg-7">
                <div class="gallery">
                  <div class="gallery-container">
                  <?php  
                  $sizeofarray = sizeof($images_array);
                  // echo "<script>console.log('".$sizeofarray."');</script>";
                  switch ($sizeofarray) {
                    case 1:
                      $i = 1;
                      $j = 3;
                      break;
                    case 2:
                        $i = 1;
                        $j = 1;
                        break;
                        case 3:
                          $i = 1;
                          $j = 1;
                          break;
                          case 4:
                            $i = 1;
                            $j = 1;
                            break;
                    default:
                    $i = 1;
                    $j = 1;
                      break;
                  }
                  // echo "<script>console.log('".$sizeofarray."');</script>";
                  // echo "<script>console.log('".$i.$j."');</script>";
                  
                  foreach($images_array as $each){
                    $replacement = './assets/images/sin_cara.svg';
                    ?>    
                    <img data-index="<?php echo $i; ?>" src="<?php echo $each; ?>" onerror="this.onerror=null; this.src='<?php echo $replacement; ?>'" alt="" class="gallery-item gallery-item-<?php echo $j; ?>" />
                    <?php                    
                    $i++;
                    $j++;
                  }
                  if($sizeofarray == 2){
                    $i = 3;
                    $j = 3;
                    foreach($images_array as $each){
                      $replacement = './assets/images/sin_cara.svg';
                      ?>    
                      <img data-index="<?php echo $i; ?>" src="<?php echo $each; ?>" onerror="this.onerror=null; this.src='<?php echo $replacement; ?>'" alt="" class="gallery-item gallery-item-<?php echo $j; ?>" />
                      <?php                    
                      $i++;
                      $j++;
                    }
                  }

                  if($sizeofarray == 3){
                    $i = 4;
                    $j = 4;
                    foreach($images_array as $each){
                      $replacement = './assets/images/sin_cara.svg';
                      ?>    
                      <img data-index="<?php echo $i; ?>" src="<?php echo $each; ?>" onerror="this.onerror=null; this.src='<?php echo $replacement; ?>'" alt="" class="gallery-item gallery-item-<?php echo $j; ?>" />
                      <?php                    
                      $i++;
                      $j++;
                    }
                  }
?>

                     <!-- <img
                      class="gallery-item gallery-item-3"
                      src="./assets/images/sin_cara.svg"
                      data-index="3"
                    />
                    <img
                      class="gallery-item gallery-item-4"
                      src="./assets/images/sin_cara.svg"
                      data-index="4"
                    />
                     <img
                      class="gallery-item gallery-item-5"
                      src="./assets/images/sin_cara.svg"
                      data-index="5"
                    /><img
                      class="gallery-item gallery-item-6"
                      src="./assets/images/sin_cara.svg"
                      data-index="6"
                    />  -->
                  </div>
                  <?php 
                                    if($sizeofarray == 0){
                                      ?>
<img
                      class="gallery-item gallery-item-6"
                      src="./assets/images/sin_cara.svg"
                      data-index="6"
                    /> 
                                      <?php
                                    }
                  if($sizeofarray == 1 || $sizeofarray == 0){
                    $hidden = "style='visibility:hidden;'";
                  }
                  else{
                    $hidden = "";
                  }
                  ?>
                                      <div class="gallery-controls" <?php echo $hidden ?>></div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="product-specs-outer">
                  <div class="product-specs-inner">
                    <h4 class="product-title"><?php echo $wrestler; ?></h4>
                    <h5 class="product-tier"><?php echo $SKU; ?></h5>
                    <!-- <div class="product-actions">
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
                    </div> -->
                    <table class="table">
                      <tr>
                        <th>Brand</th>
                        <td><?php echo $Brand; ?></td>
                      </tr>
                      <tr>
                        <th>Line</th>
                        <td><?php echo $line; ?></td>
                      </tr>
                      <tr>
                        <th>Subline</th>
                        <td><?php echo $subline; ?></td>
                      </tr>
                      <tr>
                        <th>Series</th>
                        <td><?php echo $series; ?></td>
                      </tr>
                      <tr>
                        <th>Year</th>
                        <td><?php echo $year; ?></td>
                      </tr>
                    </table>
                    <?php 
                                if(empty($_SESSION['employee_username1'])){

                                }
                                else{
                                    $conn->next_result();
                                    $sql21 = "CALL wish_list_of_a_user('$id', '$product_id')";
                                    $result21 = $conn->query($sql21);

                                    if ($result21->num_rows > 0) {
                                    // output data of each row
                                    while($row21 = $result21->fetch_assoc()) {
                                            $disabled_wishlist = "wishlist";
                                    }
                                }
                                ?>

                                <?php
                                if($disabled_wishlist == ""){
                                ?>
                                                    <button class="btn btn-primary action" <?php echo $disabled_wishlist; ?> onclick="add_to_wishlist('<?php echo $id; ?>', '<?php echo $product_id; ?>')">
                                                      <img src="./assets/images/gift_white.svg" alt="" />
                                                      Add to Wishlist
                                                    </button>
                                <?php
                                }
                                else{
?>
                                                    <button class="btn btn-primary action" <?php echo $disabled_wishlist; ?> disabled>
                                                      <img src="./assets/images/gift_white.svg" alt="" />
                                                      Saved in Wishlist
                                                    </button>

<?php                                  
                                }
                                
                              }
                                ?>
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
    <div id="div1212"></div>
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
    <script src="./assets/OwlCarousel/js/owl.carousel.js"></script>
    <script src="./assets/vanilla-js-carousel-master/carousel.js"></script>
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
      $(document).ready(function () {
        $(".carousel").carousel({});

        $(".carousel-control-prev, .carousel-control-next").click(function () {
          var mainParent = $("#carouselExampleControlsNoTouching").children(
            ".carousel-inner"
          );

          mainParent.children(".carousel-item").removeClass("leftImage");
          mainParent.children(".carousel-item").removeClass("rightImage");
          if (
            mainParent.children(".carousel-item").first().hasClass("active")
          ) {
            mainParent
              .children(".carousel-item")
              .first()
              .next()
              .addClass("rightImage");
          } else if (
            mainParent.children(".carousel-item").last().hasClass("active")
          ) {
            mainParent
              .children(".carousel-item")
              .last(".carousel-item")
              .prev(".carousel-item")
              .addClass("rightImage");
          } else {
            mainParent.children(".carousel-item").removeClass("leftImage");
            mainParent.children(".carousel-item").removeClass("rightImage");
            mainParent
              .children(".carousel-item.active")
              .next(".carousel-item")
              .addClass("rightImage");
            mainParent
              .children(".carousel-item.active")
              .prev(".carousel-item")
              .addClass("leftImage");
          }
        });
      });

      function add_to_wishlist(user_id, wrestler_id){
        document.getElementById("loader1").style.visibility = "visible";
        // alert(user_id);
        // alert(wrestler_id);
        $.ajax({
          type: "post",
          data: {user_id:user_id, wrestler_id: wrestler_id},
          url: "controllers/add_to_wishlist_controller.php",
          success: function (result) {
            $("#div1212").html(result);
             document.getElementById("loader1").style.visibility = "hidden";
          }
        });
        // console.log(user_id);
        // console.log(wrestler_id);
    }
    </script>
  </body>
</html>
