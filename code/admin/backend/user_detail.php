<style>
  @media screen and (max-width: 1100px){
    #tabele{
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
                                              <td class="mupointer" onclick="remove_from_wishlist_employee('<?php echo $id; ?>','<?php echo $idofwrestlingfigure; ?>')">Remove from Wishlist</td>
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
</script>