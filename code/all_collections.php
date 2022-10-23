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
    $loggedinuserid = $row['id'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Collections</title>

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
              <h4 class="title">All Collections</h4>
              <div class="filters">
                <div class="dropdown me-lg-4 me-3">
                  <button class="btn btn-outline-primary2 text-center" style="display: block;" type="button"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New Collection
                  </button>
                </div>
                <div class="modal fade"  style="color: black;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Collection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="new_collection">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Collection Name</label>
                            <input name="collection_name" style="color: black;" type="text" class="form-control" id="exampleInputEmail1"
                              aria-describedby="emailHelp">
                          </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="list-collection table-responsive rounded bg-darkblue py-3 px-1">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Collection Name</th>
                    <th scope="col">Created On</th>
                    <th scope="col">No. of Wrestlers</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $conn->next_result();
                    $sql21 = "CALL all_collections('$loggedinuserid')";
                    $result21 = $conn->query($sql21);

                    if ($result21->num_rows > 0) {
                    // output data of each row
                    while($row21 = $result21->fetch_assoc()) {
                      $id_of_collection = $row21['id'];
                      // echo "<script>console.log('$id_of_collection')</script>";
                      // $result->close();
                      $conn->next_result();
                                    $sql212 = "CALL count_wrestling_figures_in_a_collection('$id_of_collection')";
                                    $result212 = $conn->query($sql212);

                                    if ($result212->num_rows > 0) {
                                    // output data of each row
                                    while($row212 = $result212->fetch_assoc()) {
                                            $number_of_figures = $row212['noofrestlingfigures'];
                                    }
                                }
                      ?>
                      <tr>
                        <td><a href="./singlecollection.php?col=<?php echo $id_of_collection; ?>&name=<?php echo $row21['name1']; ?>"><?php echo $row21['name1']; ?></a></td>
                        <td><?php echo $row21['created_on']; ?></td>
                        <td><?php echo $number_of_figures; ?></td>
                        <td><span class="material-icons material-icons-outlined">delete</span></td>
                        <td>
                          Edit
                        </td>
                      </tr>                      
                      <?php
                    }
                }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
    <footer>
      <img src="./assets/images/logo.svg" width="316" class="img-fluid" alt="" />
    </footer>
  </section>
<div id="div11"></div>
<div class="loading" id="loader1" style="visibility: hidden;">Loading&#8230;</div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
  </script>
    <script>
    var request;

    $("#new_collection").submit(function (event) {

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

      // Serialize the data in the form
      var serializedData = $form.serialize();
      document.getElementById("loader1").style.visibility = "visible";
      $.ajax({
        type: "post",
        data: serializedData,
        url: "controllers/new_collection_controller.php",
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