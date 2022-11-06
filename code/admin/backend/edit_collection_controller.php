


<?php
include("../../controllers/db.php");
$updated_col_name = $_POST['updated_col_name'];
$id_of_collection = $_POST['id_of_collection'];
$sql = "call update_collection('$updated_col_name','$id_of_collection')";
if($conn->query($sql)){
    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done...',
      text: 'Collection is Updated!',
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