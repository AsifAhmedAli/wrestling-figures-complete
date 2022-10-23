<?php
include("./db.php");
session_start();
if(!empty($_SESSION['employee_username1'])){
    $loggedinuseremail = $_SESSION['employee_username1'];
    $sql = "CALL select_logged_in_user_details('$loggedinuseremail')";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
      $loggedinuserid = $row['id'];
    }
  }
// if(empty($_SESSION['employee_username1'])){
//   echo "<script>window.location.replace('login.php');</script>";
// }
$collection_name = $_POST['collection_name'];
$conn->next_result();
$sql = "CALL collection_name_validation('$loggedinuserid', '$collection_name')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<script>Swal.fire({
    icon: 'error',
    title: 'Duplicate Name',
    text: 'A Collection with this name already exists!'
  })</script>";
}

else{
    $conn->next_result();
    //   echo "<script>console.log('".$collection_name."')</script>";
    $sqlq = "CALL add_new_collection('$collection_name', '$loggedinuserid')";
    if ($conn->query($sqlq) === TRUE) {
        // if(unlink('../../../wrestler_images/'.$nameofimage)){
            echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Added...',
              text: 'New Collection has been successfully added!',
              allowOutsideClick: false
            })
            $( 'button.swal2-confirm' ).click(function() {
                window.location.reload();
            });
            </script>";
        }    
}

?>