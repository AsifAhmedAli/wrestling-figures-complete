<?php
include("../../controllers/db.php");
$idofwrestler = $_POST['x'];

$sql = "CALL get_product_details('$idofwrestler')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  $wrestler = $row['wrestler'];
  $SKU = $row['SKU'];
  $Brand = $row['Brand'];
  $line = $row['line'];
  $subline = $row['subline'];
  $Figure = $row['figure'];
  $year = $row['year'];
  $series = $row['series'];
}
?>
    <h3 class="text-center">
        Edit Wrestling Figure
    </h3>
<form id="addwrestler">
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
        <input value="<?php echo $wrestler  ?>" type="text" id="Wrestler" name="Wrestler" class="form-control" placeholder="Enter Wrestler">
        <input value="<?php echo $SKU  ?>" type="text" id="SKU" name="SKU" class="form-control" placeholder="Enter SKU">
        </div>
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
        <input value="<?php echo $Brand  ?>" type="text" id="Brand" name="Brand" class="form-control" placeholder="Enter Brand">   
        <input value="<?php echo $line  ?>" type="text" id="Line" name="Line" class="form-control" placeholder="Enter Line">
        </div>
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
        <input value="<?php echo $subline  ?>" type="text" id="Subline" name="Subline" class="form-control" placeholder="Enter Subline">
        <input value="<?php echo $series  ?>" type="text" id="Series" name="Series" class="form-control" placeholder="Enter Series">
            
        </div>
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
            <input value="<?php echo $year  ?>" type="text" id="Year" name="Year" class="form-control" placeholder="Enter Year">
            <input value="<?php echo $Figure  ?>" type="text" id="Figure" name="Figure" class="form-control" placeholder="Enter Figure">
        </div>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary mx-auto" type="submit">Update Now</button>
        </div>
        <input type="text" name="id_of_wrestler" style="visibility: hidden;" value="<?php echo $idofwrestler; ?>">
    </form>
<div id="oasndflk"></div>
    <script>
            var request;

$("#addwrestler").submit(function (event) {
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
        url: "./backend/update_wrestling_figure_controller.php",
        success: function (result) {
            $("#oasndflk").html(result);
            document.getElementById("loader1").style.visibility = "hidden";
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

    </script>