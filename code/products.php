<?php
include("./controllers/db.php");
if(isset($_GET['no'])){
  $current_page = $_GET['no'];
}
else{
  $current_page = 1;
}

session_start();
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
    <title>Products</title>

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
        <section class="products">
          <h4 class="heading">Search your favourite Wrestling Figure.</h4>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-8 col-12 mx-auto">
                <div class="search-fig-container">
                  <!-- <form action=""> -->
                    <div
                      class="row align-items-center justify-content-center gy-3"
                    >
                      <div class="col">
                        <select name="brand" id="brand" class="form-select">
                          <option value="" selected disabled>Brand</option>
                        <?php
                                      if(isset($result)){
                                        $result->close();
                                        $conn->next_result();
                                      }
                        $sql = "SELECT DISTINCT(Brand) FROM wrestling_figures";
                        $result = $conn->query($sql);
                        // echo("Error description: " . $conn -> error);
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['Brand'] ?>"><?php echo $row['Brand'] ?></option>
                            <?php
                            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                          }
                        } 
                        ?>  
                        </select>
                      </div>
                      <div class="col">
                        <select name="" id="series" class="form-select">
                        <option value="" selected disabled>Series</option>
                        <?php
                                      if(isset($result)){
                                        $result->close();
                                        $conn->next_result();
                                      }
                        $sql = "SELECT DISTINCT(series) FROM wrestling_figures";
                        $result = $conn->query($sql);
                        // echo("Error description: " . $conn -> error);
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['series'] ?>"><?php echo $row['series'] ?></option>
                            <?php
                            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                          }
                        } 
                        ?>  
                          
                        </select>
                      </div>
                      <div class="col">
                        <select name="" id="year" class="form-select">
                          <option value="" selected disabled>Year</option>
                        <?php
                                      if(isset($result)){
                                        $result->close();
                                        $conn->next_result();
                                      }
                        $sql = "SELECT DISTINCT(year) FROM wrestling_figures";
                        $result = $conn->query($sql);
                        // echo("Error description: " . $conn -> error);
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['year'] ?>"><?php echo $row['year'] ?></option>
                            <?php
                            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                          }
                        } 
                        ?>  
                        </select>
                      </div>
                      <div class="col">
                        <input
                          type="text"
                          id="nameofwrestler"
                          class="form-control"
                          placeholder="Wrestler Name"
                        />
                      </div>
                      <div class="col">
                        <button type="button" onclick="fetch_products_with_filter(1, '<?php echo $id; ?>')">Search</button>
                      </div>
                    </div>
                  <!-- </form> -->
                </div>
              </div>
            </div>
            <div class="row g-xl-4 g-3" id="show_products_here">
             
            </div>

            <div class="text-center products-pagination" id="pagination_results">

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
      function fetch_products(xa, id){
        document.getElementById("loader1").style.visibility = "visible";
        $.ajax({
          type: "post",
          data: {xa:xa, id:id},
          url: "controllers/fetch_products.php",
          success: function (result) {
            $("#show_products_here").html(result);
             document.getElementById("loader1").style.visibility = "hidden";
          }
        });
      }
      function fetch_pagination(current_page){
        document.getElementById("loader1").style.visibility = "visible";
        $.ajax({
          type: "post",
          data: {current_page:current_page},
          url: "controllers/pagination_controller.php",
          success: function (result) {
            $("#pagination_results").html(result);
             document.getElementById("loader1").style.visibility = "hidden";
          }
        });
      }
      function fetch_pagination1(current_page, counter){
        document.getElementById("loader1").style.visibility = "visible";
        filter = "yes";
        $.ajax({
          type: "post",
          data: {current_page: current_page, counter:counter, filter:filter},
          url: "controllers/pagination_controller.php",
          success: function (result) {
            $("#pagination_results").html(result);
             document.getElementById("loader1").style.visibility = "hidden";
          }
        });
      }

      function fetch_products_with_filter(fil, id){
        document.getElementById("loader1").style.visibility = "visible";
        var brand = document.getElementById("brand").value;
        var series = document.getElementById("series").value;
        var year = document.getElementById("year").value;
        var nameofwrestler = document.getElementById("nameofwrestler").value;
        $.ajax({
          type: "post",
          data: {fil:fil,series:series, brand:brand, year:year, nameofwrestler:nameofwrestler, id:id},
          url: "controllers/fetch_products.php",
          success: function (result) {
            $("#show_products_here").html(result);
             document.getElementById("loader1").style.visibility = "hidden";
            var counter = document.getElementById("counter").value;
            // alert(counter);
            fetch_pagination1(1, counter);
          }
        });
      }

    </script>
    <?php

    echo "<script>fetch_products('".$current_page."','".$id."')</script>";
    echo "<script>fetch_pagination(".$current_page.")</script>";
    ?>

  </body>
</html>
