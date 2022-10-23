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
        <th>Edit</th>    
      </tr>
    </thead>
    <tbody>
<?php
  while($row = $result->fetch_assoc()) {
      $idofemployee = $row['id'];
      $name1 = $row['name1'];
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
<td class="mupointer" onclick="edit_employee('<?php echo $idofemployee; ?>')"><i class="fa fa-edit"></i></td>
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
<script>
    function delete_employee(x,y){
      document.getElementById('loader1').style.visibility = 'visible';
// alert(x);
// alert(y);
          $.ajax({
                type: "post",
                data: {x:x, y:y},
                url: "delete_employee.php",
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
</script>