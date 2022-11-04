<?php
include("./db.php");
$user_id = $_POST['user_id'];
$figure_id = $_POST['figure_id'];
$col_id = $_POST['col_id'];

$sql = "call remove_from_collection('$figure_id', '$col_id')";
if($conn->query($sql)){
    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done...',
      text: 'Removed from collection!',
      allowOutsideClick: false
    })
    $( 'button.swal2-confirm' ).click(function() {
        window.location.reload();
    });
    </script>";
}

?>