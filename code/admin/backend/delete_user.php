<?php
include("../../controllers/db.php");
$user_id = $_POST['user_id'];
// $user_id = $_POST['user_id'];
// $idofwrestlerw2 = $_POST['z1'];
// echo "<script>x = ".$idofwrestlerw2."</script>";
$sqlq = "CALL delete_user_and_all_data('$user_id')";
if ($conn->query($sqlq) === TRUE) {
    // if(unlink('../../../wrestler_images/'.$nameofimage)){
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Deleted...',
          text: 'User and all his data has been deleted Successfully!',
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