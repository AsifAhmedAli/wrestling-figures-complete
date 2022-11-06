<style>
  @media screen and (max-width: 1100px){
    #tabele{
          overflow: auto;
          white-space: nowrap;       
    }
    #tabele1{
          overflow: auto;
          white-space: nowrap;       
    }
}
</style>
<?php
include("../../controllers/db.php");
$id = $_POST['x'];
$name = $_POST['name'];
// echo "<script>console.log('".$id."')</script>";

?>
<div class="modal  bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h3 class="modal-title">User: <b><?php echo $name; ?></b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="tabele" class="modal-body">
        <h3 class="text-center">Wishlist</h3>
        <table class="table table-hover text-center table-bordered table-striped">
        <thead>
          <tr>
            <th>Wrestler Name</th>
            <th>SKU</th>
            <th>Brand</th>  
            <th>Added to Wishlist on</th>  
            <th></th>
            <!-- <th>Edit</th>     -->
          </tr>
        </thead>
        <tbody>
          <?php
                        $sql21 = "CALL wish_list_of_a_user_with_figure_details('$id')";
                                    $result21 = $conn->query($sql21);
                                    if ($result21->num_rows > 0) {
                                    // output data of each row
                                    while($row21 = $result21->fetch_assoc()) {
                                      $idofwrestlingfigure = $row21['id'];
                                            ?>
                                            <tr>
                                              <td class="mupointer"> <a href="../productsitem.php?id=<?php echo $idofwrestlingfigure; ?>" target="_blank" style="text-decoration: none;color:#858796;"><?php echo $row21['wrestler']; ?></a></td>
                                              <td><?php echo $row21['SKU']; ?></td>
                                              <td><?php echo $row21['Brand']; ?></td>
                                              <td><?php echo $row21['date_added']; ?></td>
                                              <td class="mupointer" onclick="remove_from_wishlist_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>')"><i class="fa fa-trash"></i></td>
                                            </tr>
                                            <?php
                                    }
                                }
                                // echo("Error description: " . $conn -> error);
          ?>
        </tbody>
        </table>
      </div>
      <div id="tabele1" class="modal-body">
        <h3 class="text-center">Collections</h3>
        <table class="table table-hover text-center table-bordered table-striped">
        <thead>
          <tr>
            <th>Collection Name</th>
            <th>Created on</th>  
            <th>Edit</th>  
            <th>Delete</th> 
          </tr>
        </thead>
        <tbody>
          <?php
                        $conn->next_result();
                        $sql21 = "CALL all_collections('$id')";
                                    $result21 = $conn->query($sql21);
                                    if ($result21->num_rows > 0) {
                                    // output data of each row
                                    while($row21 = $result21->fetch_assoc()) {
                                      $idofcollection = $row21['id'];
                                      $nameofcollection = $row21['name1'];
                                            ?>
                                             <tr>
                                               <td class="mupointer"><?php echo $row21['name1']; ?></td>
                                               <td><?php echo $row21['created_on']; ?></td>
                                               <td class="mupointer" onclick="edit_collection('<?php echo $idofcollection; ?>', '<?php echo $nameofcollection; ?>')"><i class="fa fa-edit"></i></td>
                                               <td class="mupointer" onclick="delete_collection('<?php echo $idofcollection; ?>')"><i class="fa fa-trash"></i></td>
                                               <!-- <td class="mupointer" onclick="remove_from_wishlist_employee('<?php //echo $id; ?>','<?php //echo $idofwrestlingfigure; ?>')">Remove from Wishlist</td> -->
                                             </tr>
                                             <?php
                                    }
                                }
                                // echo("Error description: " . $conn -> error);
          ?>
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- edit modal -->
<div class="modal fade"  style="color: black;" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1"
                  aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Collection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="edit_collection">
                          <div class="mb-3">

                            <label for="exampleInputEmail1" class="form-label">Collection Name</label>
                            <input value="<?php //echo $; ?>" id="edit_col_name" name="updated_col_name" style="color: black;" type="text" class="form-control">
                            <input id="collectionsaas" name="id_of_collection" style="visibility: hidden;">
                          </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                      </div>
                    </div>
                  </div>
</div>

<div id="div122"></div>
<script>
    $('#mymodal').modal('show');

    function remove_from_wishlist_employee(user_id, figure_id){
      // console.log(x);
      document.getElementById('loader1').style.visibility = 'visible';
      $.ajax({
                type: "post",
                data: {user_id:user_id,figure_id:figure_id},
                url: "./backend/remove_from_wishlist_controller.php",
                success: function (result) {
                  $('#mymodal').modal('hide');
                    $("#div122").html(result);
                    document.getElementById('loader1').style.visibility = 'hidden';
                }
            });
    }
    function delete_collection(col_id){
      // console.log(x);
      document.getElementById('loader1').style.visibility = 'visible';
      $.ajax({
                type: "post",
                data: {col_id:col_id},
                url: "./backend/delete_collection.php",
                success: function (result) {
                  $('#mymodal').modal('hide');
                    $("#div122").html(result);
                    document.getElementById('loader1').style.visibility = 'hidden';
                }
            });
    }
    function edit_collection(col_id, col_name){
      $('#mymodal').modal('hide');
      $('#exampleModal1').modal('show');
      document.getElementById("collectionsaas").value = col_id;
      document.getElementById("edit_col_name").value = col_name;
    }
    var request;
    $("#edit_collection").submit(function (event) {
      $('#exampleModal1').modal('hide');
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
        url: "backend/edit_collection_controller.php",
        success: function (result) {
          $("#div122").html(result);
          document.getElementById("loader1").style.visibility = "hidden";
        }
      });
      });
</script>