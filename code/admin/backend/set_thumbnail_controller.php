<?php
include("../../controllers/db.php");
$idofimage = $_POST['x'];
// $nameofimage = $_POST['y1'];
$wrestler_id = $_POST['y1'];
// echo "<script>x = ".$idofwrestlerw2."</script>";
$sqlq = "CALL set_thumbnail('$idofimage', '$wrestler_id')";
if ($conn->query($sqlq) === TRUE) {
    // if(unlink('../../../wrestler_images/'.$nameofimage)){
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Updated...',
          text: 'Image has been successfully set as Thumbnail!',
          allowOutsideClick: false
        })
        $( 'button.swal2-confirm' ).click(function() {
            window.location.reload();
        });
        </script>";
    }
//   }
?>