<?php
include("./db.php");
session_start();
$id = $_POST['id'];

if(isset($_POST['xa'])){
    allfigures($conn, $start_limit, $id);
}
if(isset($_POST['fil'])){
    withfilter($conn, $start_limit, $id);
}

// echo "<script>console.log('".$id."');</script>";
// echo "<script>console.log('".$end_limit."');</script>";
// $start_limit = $pagenumber * 20;
// $nameofimage = $_POST['y1'];
// $wrestler_id = $_POST['y1'];
// echo "<script>x = ".$idofwrestlerw2."</script>";

function allfigures($conn, $start_limit, $id){
            $pagenumber = $_POST['xa'];
            if($pagenumber == 1){
                // $last_page = $pagenumber - 1;
                $start_limit = 0;
                $end_limit = 19;
            }
            else{
                $last_page = $pagenumber - 1;
                $start_limit = $last_page * 20;
                // $start_limit++;
                $end_limit = $pagenumber * 20;
                $end_limit--;
            }
            if(isset($result)){
                $result->close();
                $conn->next_result();
              }
            $sqlq = "CALL all_wrestling_figures_with_limit('$start_limit', '20')";
            $result = $conn->query($sqlq);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $wrestler = $row['wrestler'];
                $wrestlerid = $row['wrestlerid'];
                $disabled_wishlist = "";
                $disabled_collection = "";
                // $result->close();
                $conn->next_result();
                $sqlq1 = "CALL all_images_with_id_of_wrestler_thumbnail('$wrestlerid')";
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
                // echo "<script>console.log('".$thumbnail."')</script>";
                ?>
                        <div class="col-lg-3 col-md-6 col-12">
                        <?php
                                if($thumbnail == 'yes'){
                                     $selected_image = $image_name;
                                     $selected_image1 = "../wrestler_images/".$image_name;
                                }
                                else{
                                    $selected_image = './assets/images/sin_cara.svg';
                                }
                        ?>
                            <div class="product-container">
                                <a href="./productsitem.php?id=<?php echo $wrestlerid; ?>" style="text-decoration:none;">
                                    <img src="<?php echo $selected_image; ?>" onerror="this.onerror=null; this.src='<?php echo $selected_image1; ?>'" alt="" class="product-img" />
                                    <span class="product-title"><?php echo $wrestler; ?></span>
                                </a>
                                <div class="product-actions">
                                <?php 
                                if(empty($_SESSION['employee_username1'])){

                                }
                                else{
                                    $conn->next_result();
                                    $sql21 = "CALL wish_list_of_a_user('$id', '$wrestlerid')";
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
                                    <button class="wishlist me-2" <?php echo $disabled_wishlist; ?> onclick="add_to_wishlist('<?php echo $id; ?>', '<?php echo $wrestlerid; ?>')">
                                        <img src="./assets/images/gift.svg" width="28" height="28" alt="" />
                                    </button>
                                <?php
                                }
                            }
                                if(empty($_SESSION['employee_username1'])){

                                }
                                else{
                                    $conn->next_result();
                                    $sql21 = "CALL collections_of_a_user('$id', '$wrestlerid')";
                                    $result21 = $conn->query($sql21);

                                    if ($result21->num_rows > 0) {
                                    // output data of each row
                                    while($row21 = $result21->fetch_assoc()) {
                                            $disabled_collection = "wishlist";
                                    }
                                }
                                if($disabled_collection == ""){
                                ?>
                                    <button class="create-new ms-2" onclick="showmodalas('<?php echo $wrestlerid ?>')">
                                        <span class="material-icons material-icons-outlined">create_new_folder</span>
                                    </button>
                                
                                <?php
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </div>

                <?php
                // echo "<script>
                // console.log('".$id."');
                // </script>";
            }
            }
}

function withfilter($conn, $start_limit, $id){
    
    $brand = $_POST['brand'];
    $series = $_POST['series'];
    $year = $_POST['year'];
    $nameofwrestler = $_POST['nameofwrestler'];
    
    $query = "";
    if($brand != ""){
        $query .= " Brand = '".$brand. "' and ";
    }
    if($series != ""){
        $query .= " series = '".$series. "' and ";
    }
    if($year != ""){
        $query .= " year = '".$year. "' and ";
    }
    if($nameofwrestler != ""){
        $query .= " wrestler = '".$nameofwrestler. "' and ";
    }
    $query = substr_replace($query ,"", -4);
    // echo $query;
    // echo "<script>console.log('".$query."')</script>";
    $pagenumber = $_POST['fil'];
    if($pagenumber == 1){
        // $last_page = $pagenumber - 1;
        $start_limit = 0;
        $end_limit = 20;
    }
    else{
        $last_page = $pagenumber - 1;
        $start_limit = $last_page * 20;
        // $start_limit++;
        $end_limit = $pagenumber * 20;
        $end_limit--;
    }
    $counter = 0;
    $sqlq = "SELECT count(id) counter2 from wrestling_figures where $query";
    $result = $conn->query($sqlq);
    // echo $sqlq;
    // echo("Error description: " . $conn -> error);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $counter = $row['counter2'];
        }
    }
    // $sqlq = "CALL all_wrestling_figures_with_limit_with_filter('$query')";
    // $sqlq = "SELECT wrestler, id as wrestlerid from wrestling_figures where $query  ORDER BY wrestlerid ASC LIMIT $start_limit, $end_limit";
    $sqlq = "SELECT wrestler, id as wrestlerid from wrestling_figures where $query ORDER BY wrestlerid ASC";
    $result = $conn->query($sqlq);
    // echo $sqlq;
    // echo("Error description: " . $conn -> error);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // $counter++;
        $disabled_wishlist = "";
        $disabled_collection = "";
        $wrestler = $row['wrestler'];
        $wrestlerid = $row['wrestlerid'];
        // $result->close();
        $conn->next_result();
        $sqlq1 = "CALL all_images_with_id_of_wrestler_thumbnail('$wrestlerid')";
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
        // echo "<script>console.log('".$thumbnail."')</script>";
        ?>
    <div class="col-lg-3 col-md-6 col-12">
                        <?php
                                if($thumbnail == 'yes'){
                                     $selected_image = $image_name;
                                     $selected_image1 = "../wrestler_images/".$image_name;
                                }
                                else{
                                    $selected_image = './assets/images/sin_cara.svg';
                                }
                        ?>
                            <div class="product-container">
                                <a href="./productsitem.php?id=<?php echo $wrestlerid; ?>" style="text-decoration:none;">
                                    <img src="<?php echo $selected_image; ?>" onerror="this.onerror=null; this.src='<?php echo $selected_image1; ?>'" alt="" class="product-img" />
                                    <span class="product-title"><?php echo $wrestler; ?></span>
                                </a>
                                <div class="product-actions">
                                <?php 
                                if(empty($_SESSION['employee_username1'])){

                                }
                                else{
                                    $conn->next_result();
                                    $sql21 = "CALL wish_list_of_a_user('$id', '$wrestlerid')";
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
                                    <button class="wishlist me-2" <?php echo $disabled_wishlist; ?> onclick="add_to_wishlist('<?php echo $id; ?>', '<?php echo $wrestlerid; ?>')">
                                        <img src="./assets/images/gift.svg" width="28" height="28" alt="" />
                                    </button>
                                <?php
                                }
                            }
                                if(empty($_SESSION['employee_username1'])){

                                }
                                else{
                                    $conn->next_result();
                                    $sql21 = "CALL collections_of_a_user('$id', '$wrestlerid')";
                                    $result21 = $conn->query($sql21);

                                    if ($result21->num_rows > 0) {
                                    // output data of each row
                                    while($row21 = $result21->fetch_assoc()) {
                                            $disabled_collection = "wishlist";
                                    }
                                }
                                if($disabled_collection == ""){
                                ?>
                                    <button class="create-new ms-2" onclick="showmodalas('<?php echo $wrestlerid ?>')">
                                        <span class="material-icons material-icons-outlined">create_new_folder</span>
                                    </button>
                                
                                <?php
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </div>
        <?php
        // echo "<script>
        // console.log('".$id."');
        // </script>";
    }
    }
    ?>
    <input type="text" style="visibility: hidden;" value="<?php echo $counter ?>" id="counter">
    <?php
}
?>

<!-- Collections Modal -->
<div class="modal fade" style="color: black;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add to Collection</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">          
        <select style="color: black;" id="selected_collection" required class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option value="" selected disabled>Select Collection</option>
            
            <?php
                $conn->next_result();
                $sqlq1 = "CALL all_collections('$id')";
                $result1 = $conn->query($sqlq1);

                if ($result1->num_rows > 0) {
                // output data of each row
                while($row1 = $result1->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row1['id'] ?>"><?php echo $row1['name1'] ?></option>
                    <?php
                    }
                }
            ?>            
        </select>
        <input type="text" style="visibility: hidden;" id="wrester_idas">
            <div class="text-end mt-3">
                <button onclick="add_to_collection('<?php echo $id; ?>')" type="button" class="btn btn-primary">Add</button>
            </div>
      </div>
    </div>
  </div>
</div>
<div id="div1212"></div>
<script>
    function add_to_wishlist(user_id, wrestler_id){
        document.getElementById("loader1").style.visibility = "visible";
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
    function add_to_collection(){
        collection_id = document.getElementById("selected_collection").value;
        wrestler_id = document.getElementById("wrester_idas").value;
        document.getElementById("loader1").style.visibility = "visible";
        
        if(collection_id == ""){
            alert("Please select a collection");
            document.getElementById("loader1").style.visibility = "hidden";
            // alert(collection_id + " " + user_id + " " + wrestler_id);
        }
        else{
            $.ajax({
                type: "post",
                data: {collection_id:collection_id, wrestler_id: wrestler_id},
                url: "controllers/add_to_collection_controller.php",
                success: function (result) {
                    $("#div1212").html(result);
                    document.getElementById("loader1").style.visibility = "hidden";
                }
            });
        }
    }
    function showmodalas(wrestler_id){
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
        myModal.show();
        document.getElementById("wrester_idas").value = wrestler_id;
        // alert(document.getElementById("wrester_idas").value);
    }
    
</script>