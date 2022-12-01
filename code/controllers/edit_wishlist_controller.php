<?php
include("./db.php");
$updated_wishlist_name = $_POST['updated_wishlist_name'];
$id_of_wishlist = $_POST['id_of_wishlist'];
$sql = "call update_wishlist('$updated_wishlist_name','$id_of_wishlist')";
if($conn->query($sql)){
    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done...',
      text: 'Wishlist is Updated!',
      allowOutsideClick: false
    })
    $( 'button.swal2-confirm' ).click(function() {
        window.location.reload();
    });
    </script>";
}

?>