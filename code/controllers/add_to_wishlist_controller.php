<?php
include("./db.php");
$wishlist_id = $_POST['wishlist_id'];
$wrestler_id = $_POST['wrestler_id'];
// echo "<script>console.log('".$user_id.$wrestler_id."')</script>";
$sql = "CALL add_to_wish_list('$wishlist_id', '$wrestler_id')";
if($conn->query($sql)){
    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done...',
      text: 'Figure has been added to the Wishlist!',
      allowOutsideClick: false
    })
    $( 'button.swal2-confirm' ).click(function() {
      location.reload();
    });
    </script>";

}

// echo("Error description: " . $conn -> error);
?>
