<style>
    .mupointer:hover{
        cursor:pointer;
    }
</style>
<?php
include("../../controllers/db.php");
$sql = "CALL all_wrestling_figures()";
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
        <th>Wrestler</th>
        <th>SKU</th>        
        <th>BRAND</th>
        <th>Series</th>
        <th>Line</th>        
        <th>Subline</th>
        <th>Figure</th>
        <th>Year</th>
        <th>Add Images</th>
        <th>Created On</th>
        <!-- <th>Delete</th> -->
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
<?php
  while($row = $result->fetch_assoc()) {
      $idofwrestler = $row['id'];
?>
      <tr>
        <td><?php echo $row['wrestler']; ?></td>
        <td><?php echo $row['SKU']; ?></td>
        <td><?php echo $row['Brand']; ?></td>
        <td><?php echo $row['series']; ?></td>
        <td><?php echo $row['line']; ?></td>
        <td><?php echo $row['subline']; ?></td>
        <td><?php echo $row['figure']; ?></td>
        <td><?php echo $row['year']; ?></td>
        <td><button class="btn btn-sm btn-outline-dark" onclick="show_and_add_images('<?php echo $idofwrestler; ?>')">Add</button></td>
        <td><?php echo $row['date_created']; ?></td>
        <!-- <td class="mupointer" onclick="delete_wrestling_figure('<?php //echo $idofwrestler; ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></td> -->
<td class="mupointer" onclick="edit_wrestling_figure('<?php echo $idofwrestler; ?>')"><i class="fa fa-edit"></i></td>
      </tr>

      <?php
  }
  ?>
      </tbody>
  </table>
  <?php
} else {
  echo "<div class='text-center'>0 results</div>";
}
?>
<!--Edit Wrestling Figure Modal -->
      <!-- <h3 class="text-center">
        Edit Wrestling Figure
    </h3> -->
    

<div id="div11"></div>
<script>
  function edit_wrestling_figure(x){
    document.getElementById("loader1").style.visibility = "visible";
                $.ajax({
                type: "post",
                data: {x:x},
                url: "./backend/edit_wrestling_figure.php",
                success: function (result) {
                    $("#showhere").html(result);
                    document.getElementById("loader1").style.visibility = "hidden";
                }
            });
  }
    // function delete_wrestling_figure(x){
    //             document.getElementById("loader1").style.visibility = "visible";
    //       $.ajax({
    //             type: "post",
    //             data: {x:x},
    //             url: "delete_wrestling_figure.php",
    //             success: function (result) {
    //                 $("#div11").html(result);
    //                                 document.getElementById("loader1").style.visibility = "hidden";
    //             }
    //         });
    // }
    function show_and_add_images(x){
                document.getElementById("loader1").style.visibility = "visible";
        $.ajax({
                type: "post",
                data: {x:x},
                url: "./backend/images_modal.php",
                success: function (result) {
                    $("#div11").html(result);
                                    document.getElementById("loader1").style.visibility = "hidden";
                }
            });

        // document.getElementById
    }


    // function emapliye_details(x){

    //     $.ajax({
    //             type: "post",
    //             data: {x:x},
    //             url: "employee_detailasd.php",
    //             success: function (result) {
    //                 $("#div11").html(result);
    //             }
    //         });
    // }
</script>