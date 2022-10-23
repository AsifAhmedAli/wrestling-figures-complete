<?php
include("../../controllers/db.php");
$idofwrestler = $_POST['x'];
?>

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
                <form id="fileuploadform">
                <div class="form-group files text-center">
                    <!-- <label>Upload Your File </label> -->
                    <input required  accept="image/gif, image/jpeg, image/png" type="file" style="border-bottom: none !important;" name="files[]"  multiple>
                </div>
                <input type="text" style="visibility: hidden;" id="imagesuploadform" name="imagesuploadform" value="<?php echo $idofwrestler; ?>">
                <div class="col-12 text-right">
                <button type="submit" class="px-4 btn btn-outline-dark">Save</button>
                </div>
                  </form>
                
                
                <?php
                    $sql1 = "CALL all_images_with_id_of_wrestler('$idofwrestler')";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                    // output data of each row
                    while($row1 = $result1->fetch_assoc()) {
                        $image_name = $row1['image_name'];
                        $idofimage = $row1['id'];
                        $thumbnail = $row1['thumbnail'];
                            ?>
                            <div class="col-12 py-2 my-2" style="border:1px solid black;">
                            <!-- <img src="SomeImage.jpg"  alt=""> -->
                            <img src="<?php echo $image_name ?>" onerror="this.onerror=null; this.src='../../wrestler_images/<?php echo $image_name ?>'" style="width:100%;height:auto;" alt="">
                            </div>
                            <div class="col-12 py-2 text-center">
                                <button class="mx-auto btn btn-sm btn-outline-danger" onclick="deleteimage('<?php echo $idofimage ?>', '<?php echo $image_name ?>', '<?php echo $idofwrestler ?>')">Delete Image</button>
                                
                                <button class="mx-auto btn btn-sm btn-outline-primary"
                                <?php
                                if($thumbnail == 'yes'){
                                    echo "disabled";
                                }
                                ?>
                                onclick="set_thumbnail('<?php echo $idofimage ?>', '<?php echo $idofwrestler ?>')">Set as Thumbnail</button>
                            </div>
                            <?php
                        }
                    }
                    else{
                        echo "<div class='text-center'>0 results</div>";
                    }
                ?>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
        </div>
        <div id="div112"></div>
<script>
            $('#exampleModal').modal('show');

            var request;

$("#fileuploadform").submit(function (event) {
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
        url: "./backend/upload_images_controller.php",
        success: function (result) {
            $("#div112").html(result);
            document.getElementById("loader1").style.visibility = "hidden";
        },
cache: false,
contentType: false,
processData: false
    });
});
function deleteimage(x1, y1, z1){
    document.getElementById("loader1").style.visibility = "visible";
    $('#exampleModal').modal('hide')
    $.ajax({
        type: "post",
        data: {x1:x1,y1:y1, z1:z1},
        url: "./backend/delete_image_controller.php",
        success: function (result) {
            $("#div112").html(result);
            document.getElementById("loader1").style.visibility = "hidden";
        }
    });
}

function set_thumbnail(x, y1){
    document.getElementById("loader1").style.visibility = "visible";
    // $('#exampleModal').modal('hide')
    $.ajax({
        type: "post",
        data: {x:x, y1:y1},
        url: "./backend/set_thumbnail_controller.php",
        success: function (result) {
            $("#div112").html(result);
            document.getElementById("loader1").style.visibility = "hidden";
        }
    });
}
</script>