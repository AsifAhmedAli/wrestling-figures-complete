<style>
    .mupointer:hover{
        cursor:pointer;
    }
</style>
<?php
include("../../controllers/db.php");
$sql = "call all_users()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
?>
<style>
@media screen and (max-width: 1100px){
    #showhere{
          overflow: auto;
          white-space: nowrap;       
    }
}
</style>
<table class="table table-hover text-center table-bordered table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>  
        <th>Joining Date</th>  
        <th>Delete</th>
        <th>Wishlists Limit</th>    
        <th>Collections Limit</th>    
      </tr>
    </thead>
    <tbody>
<?php
  while($row = $result->fetch_assoc()) {
      $idofemployee = $row['id'];
      $name1 = $row['name1'];
      $numberofwishlistss = $row['noofwishlist'];
      $numberofcollections = $row['noofcollections'];
    //   $usernameofemplouee = $row['username'];
      ?>
      <tr>
        <td class="mupointer" onclick="emapliye_details('<?php echo $idofemployee; ?>', '<?php echo $name1; ?>')"><?php echo $row['name1']; ?></td>
        <td class="mupointer" onclick="emapliye_details('<?php echo $idofemployee; ?>', '<?php echo $name1; ?>')"><?php echo $row['email1']; ?></td>
        <td><?php echo $row['pass1']; ?></td>
        <td><?php echo $row['joined_on']; ?></td>
        <td class="mupointer" onclick="delete_employee('<?php echo $idofemployee; ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></td>
<td class="mupointer" onclick="editnoofwishlistsofauser('<?php echo $idofemployee ?>', '<?php echo $numberofwishlistss; ?>')"><?php echo $numberofwishlistss ?></td>
<td class="mupointer" onclick="editnoofcollectionsofauser('<?php echo $idofemployee ?>', '<?php echo $numberofcollections; ?>')"><?php echo $numberofcollections ?></td>
<!-- <td class="mupointer" onclick="edit_employee('<?php //echo $idofemployee; ?>')"><i class="fa fa-edit"></i></td> -->
      </tr>
      <?php
  }
  ?>
      </tbody>
  </table>
  <?php
} else {
  echo "0 results";
}
?>
<div id="div11"></div>
<!-- editnoofwishlistsofauser -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editnoofwishlistform">
        <div class="form-group">
          <label for="exampleInputEmail1">Number of Wishlists</label>
          <input type="number" name="updatednoofwishlist" class="form-control" id="exampleInputEmail1">
          <input type="number" name="userId" style="visibility: hidden;" class="form-control" id="exampleInputEmail2">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>


<!-- editnoofcollectionsofauser -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="editnoofcollectionsform">
        <div class="form-group">
          <label for="exampleInputEmail1">Number of Collections</label>
          <input type="number" name="updatednoofcollections" class="form-control" id="exampleInputEmail3">
          <input type="number" name="userId" style="visibility: hidden;" class="form-control" id="exampleInputEmail4">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

      </div>
    </div>
  </div>
</div>
<script>
    function delete_employee(user_id){
      document.getElementById('loader1').style.visibility = 'visible';

          $.ajax({
                type: "post",
                data: {user_id:user_id},
                url: "backend/delete_user.php",
                success: function (result) {
                    $("#div11").html(result);
                    document.getElementById('loader1').style.visibility = 'hidden';
                }
            });
    }
        function edit_employee(x){
          document.getElementById('loader1').style.visibility = 'visible';
                $.ajax({
                type: "post",
                data: {x:x},
                url: "edit_employee.php",
                success: function (result) {
                    $("#showhere").html(result);
                    document.getElementById('loader1').style.visibility = 'hidden';
                }
            });
    }
    function emapliye_details(x, name){
      document.getElementById('loader1').style.visibility = 'visible';
        $.ajax({
                type: "post",
                data: {x:x, name:name},
                url: "./backend/user_detail.php",
                success: function (result) {
                    $("#div11").html(result);
                    document.getElementById('loader1').style.visibility = 'hidden';
                }
            });
    }
    function editnoofwishlistsofauser(x, y){
      // exampleInputEmail1
      // exampleInputEmail2
      document.getElementById("exampleInputEmail1").value = y;
      document.getElementById("exampleInputEmail2").value = x;
      $('#exampleModal1').modal('show');
    }
    function editnoofcollectionsofauser(x, y){
      document.getElementById("exampleInputEmail3").value = y;
      document.getElementById("exampleInputEmail4").value = x;
      $('#exampleModal').modal('show');
    }


    var request;

$("#editnoofwishlistform").submit(function (event) {
  $('#exampleModal1').modal('hide');
    // alert(document.getElementById("imagesuploadform").value);
    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var formData = new FormData(this);
    document.getElementById("loader1").style.visibility = "visible";
    $.ajax({
        type: "post",
        data: formData,
        url: "./backend/updatenoofwishlistsandcollections.php",
        success: function (result) {
            $("#div11").html(result);
            document.getElementById("loader1").style.visibility = "hidden";
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


var request;

$("#editnoofcollectionsform").submit(function (event) {
  $('#exampleModal').modal('hide');
    // alert(document.getElementById("imagesuploadform").value);
    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var formData = new FormData(this);
    document.getElementById("loader1").style.visibility = "visible";
    $.ajax({
        type: "post",
        data: formData,
        url: "./backend/updatenoofwishlistsandcollections.php",
        success: function (result) {
            $("#div11").html(result);
            document.getElementById("loader1").style.visibility = "hidden";
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

</script>