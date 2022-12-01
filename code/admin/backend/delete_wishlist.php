<?php
include("../../controllers/db.php");
$wishlist_id = $_POST['wishlist_id'];
// $user_id = $_POST['user_id'];
// $idofwrestlerw2 = $_POST['z1'];
// echo "<script>x = ".$idofwrestlerw2."</script>";
$sqlq = "CALL delete_wishlist_with_figure_in_it('$wishlist_id')";
if ($conn->query($sqlq) === TRUE) {
    // if(unlink('../../../wrestler_images/'.$nameofimage)){
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Deleted...',
          text: 'Wishlist and all its data has been deleted Successfully!',
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
    // }
  }
?>