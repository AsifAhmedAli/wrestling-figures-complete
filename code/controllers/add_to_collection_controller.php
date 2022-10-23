<?php
include("./db.php");
$collection_id = $_POST['collection_id'];
$wrestler_id = $_POST['wrestler_id'];
// echo "<script>console.log('".$collection_id.$wrestler_id."')</script>";
$sql = "CALL add_to_collection('$collection_id', '$wrestler_id')";
if($conn->query($sql)){
    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done...',
      text: 'Figure has been added to the Collection!',
      allowOutsideClick: false
    })
    $( 'button.swal2-confirm' ).click(function() {
      location.reload();
    });
    </script>";

}

// echo("Error description: " . $conn -> error);
?>
