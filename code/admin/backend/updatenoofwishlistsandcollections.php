<?php
include("../../controllers/db.php");

if(isset($_POST['updatednoofwishlist'])){
    $updatednoofwishlist = $_POST['updatednoofwishlist'];
    $userId = $_POST['userId'];
    $sql = "CALL update_user_no_of_wishlists('$updatednoofwishlist', '$userId')";
    // $result = $conn1->query($sql);
    // !$conn1 -> query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Updated...',
          text: 'The Wrestling Figure is Updated Successfully!',
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
}

if(isset($_POST['updatednoofcollections'])){
    $updatednoofcollections = $_POST['updatednoofcollections'];
    $userId = $_POST['userId'];
    $sql = "CALL update_user_no_of_collections('$updatednoofcollections', '$userId')";
    // $result = $conn1->query($sql);
    // !$conn1 -> query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Updated...',
          text: 'The Wrestling Figure is Updated Successfully!',
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
}

?>