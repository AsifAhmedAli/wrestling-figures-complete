
<?php
include("./controllers/db.php");
session_start();
if(isset($_GET['filter'])){
  $sort = $_GET['filter'];
}
else{
  $sort = "none";
}

if(isset($_GET['col']) && isset($_GET['name'])){
  $col_id = $_GET['col'];
  $col_name = $_GET['name'];
}
else{
  echo "<script>window.location.replace('./all_collections.php')</script>";
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
    <title>Collection - Single</title>

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
            <h4 class="title"><?php echo $col_name; ?></h4>
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
                        <a class="dropdown-item active" href="./singlecollectiontab.php?col=<?php echo $col_id; ?>&name=<?php echo $col_name; ?>&filter=brand">Brand</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="./singlecollectiontab.php?col=<?php echo $col_id; ?>&name=<?php echo $col_name; ?>&filter=series">Series</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="./singlecollectiontab.php?col=<?php echo $col_id; ?>&name=<?php echo $col_name; ?>&filter=year">Year</a>
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
                          href="./singlecollection.php?col=<?php echo $col_id; ?>&name=<?php echo $col_name; ?>"
                          >Card View</a
                        >
                      </li>
                      <li>
                        <a class="dropdown-item" href="./singlecollectiontab.php?col=<?php echo $col_id; ?>&name=<?php echo $col_name; ?>"
                          >Table View</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="collections-container">
                <div class="row g-xxl-4 gy-4">
                <div class="list-collection table-responsive rounded bg-darkblue py-3 px-1">
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

                  <?php

                  switch ($sort) {
                    case 'none':{
                      $conn -> next_result();
                      $sql21 = "CALL get_figures_in_a_collection('$col_id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['fig_id'];
                                    ?>
                                    <tr>
                                                          <td>                                                          
                                                            <a style="color:white;" href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                            <?php echo $row21['wrestler']; ?>
                                                          </a></td>
                                                          <td><?php echo $row21['Brand']; ?></td>
                                                          <td><?php echo $row21['series']; ?></td>
                                                          <td><?php echo $row21['year']; ?></td>
                                                          <td>
                                                            <button onclick="remove_from_collection_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>', '<?php echo $col_id; ?>')" class="btn btn-outline-light">Remove</button>
                                                          </td>
                                    </tr>
                                    <?php
                            }
                          }
                      break;
                    }
                    case 'brand':{
                      $conn -> next_result();
                      $sql21 = "CALL get_collection_of_a_user_with_figure_details_order_by_brand('$col_id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['fig_id'];
                                    ?>
                                                      <tr>
                                                          <td>                                                          
                                                            <a style="color:white;" href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                            <?php echo $row21['wrestler']; ?>
                                                          </a></td>
                                                          <td><?php echo $row21['Brand']; ?></td>
                                                          <td><?php echo $row21['series']; ?></td>
                                                          <td><?php echo $row21['year']; ?></td>
                                                          <td>
                                                          <button onclick="remove_from_collection_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>', '<?php echo $col_id; ?>')" class="btn btn-outline-light">Remove</button>
                                                          </td>
                                                        </tr>
                                    <?php
                            }
                          }
                      break;
                    }
                    case 'series':{
                      $conn -> next_result();
                      $sql21 = "CALL get_collection_of_a_user_with_figure_details_order_by_series('$col_id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['fig_id'];

                                    ?>
                                                      <tr>
                                                          <td>                                                          
                                                            <a style="color:white;" href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                            <?php echo $row21['wrestler']; ?>
                                                          </a></td>
                                                          <td><?php echo $row21['Brand']; ?></td>
                                                          <td><?php echo $row21['series']; ?></td>
                                                          <td><?php echo $row21['year']; ?></td>
                                                          <td>
                                                          <button onclick="remove_from_collection_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>', '<?php echo $col_id; ?>')" class="btn btn-outline-light">Remove</button>
                                                          </td>
                                                        </tr>
                                    <?php
                            }
                          }
                      break;
                    }
                    case 'year':{
                      $conn -> next_result();
                      $sql21 = "CALL get_collection_of_a_user_with_figure_details_order_by_year('$col_id')";
                      $result21 = $conn->query($sql21);
                          if ($result21->num_rows > 0) {
                            // output data of each row
                            while($row21 = $result21->fetch_assoc()) {
                              $idofwrestlingfigure = $row21['fig_id'];
                                    ?>
                                                      <tr>
                                                          <td>                                                          
                                                            <a style="color:white;" href="./productsitem.php?id=<?php echo $idofwrestlingfigure; ?>">
                                                            <?php echo $row21['wrestler']; ?>
                                                          </a></td>
                                                          <td><?php echo $row21['Brand']; ?></td>
                                                          <td><?php echo $row21['series']; ?></td>
                                                          <td><?php echo $row21['year']; ?></td>
                                                          <td>
                                                          <button onclick="remove_from_collection_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>', '<?php echo $col_id; ?>')" class="btn btn-outline-light">Remove</button>
                                                          </td>
                                                      </tr>
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

                      </tbody>
                    </table>
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


      function remove_from_collection_employee(user_id, figure_id, col_id){
      // console.log(x);
      document.getElementById('loader1').style.visibility = 'visible';
      $.ajax({
                type: "post",
                data: {user_id:user_id,figure_id:figure_id, col_id:col_id},
                url: "./controllers/remove_from_collection_controller.php",
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
