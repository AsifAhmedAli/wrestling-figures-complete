


<?php
include("../../controllers/db.php");
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
      document.getElementById('loader1').style.visibility = 'visible';
      $.ajax({
      type: 'post',
      url: './backend/all_users.php',
      success: function (result) {
          $('#showhere').html(result);
          document.getElementById('loader1').style.visibility = 'hidden';
      }
  });
    });
    </script>";
}

?>