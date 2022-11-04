<?php
include("./db.php");
$idofcollection = $_POST['x'];
// $nameofimage = $_POST['y1'];
// $idofwrestlerw2 = $_POST['z1'];
// echo "<script>x = ".$idofwrestlerw2."</script>";
$sqlq = "CALL delete_collection_with_figure_in_it('$idofcollection')";
if ($conn->query($sqlq) === TRUE) {
    // if(unlink('../../../wrestler_images/'.$nameofimage)){
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Deleted...',
          text: 'Collection has been Successfully!',
          allowOutsideClick: false
        })
        $( 'button.swal2-confirm' ).click(function() {
            window.location.reload();
        });
        </script>";
    // }
  }
?>