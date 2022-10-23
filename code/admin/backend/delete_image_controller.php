<?php
include("../../controllers/db.php");
$idofimage = $_POST['x1'];
$nameofimage = $_POST['y1'];
$idofwrestlerw2 = $_POST['z1'];
echo "<script>x = ".$idofwrestlerw2."</script>";
$sqlq = "CALL delete_image('$idofimage')";
if ($conn->query($sqlq) === TRUE) {
    if(unlink('../../../wrestler_images/'.$nameofimage)){
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Deleted...',
          text: 'Image has been Successfully!',
          allowOutsideClick: false
        })
        $( 'button.swal2-confirm' ).click(function() {
            $.ajax({
                type: 'post',
                data: {x:x},
                url: './backend/images_modal.php',
                success: function (result) {
                    $('#div11').html(result);
                }
            });
        });
        </script>";
    }
  }
?>