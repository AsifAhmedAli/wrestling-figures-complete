<?php
include("../../controllers/db.php");
$user_id = $_POST['user_id'];
$figure_id = $_POST['figure_id'];
$sql = "call remove_from_wishlist('$user_id','$figure_id')";
if($conn->query($sql)){
    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done...',
      text: 'Removed from Wishlist!',
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