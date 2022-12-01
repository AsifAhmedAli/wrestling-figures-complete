<?php
include("./db.php");
// session_start();
// if(empty($_SESSION['employee_username1'])){
//   echo "<script>window.location.replace('login.php');</script>";
// }

$username = $_POST['email1'];
$password = $_POST['pass1'];
$name = $_POST['name1'];
// echo "<script>alert('".$name.$username.$password."');</script>";
$sql = "SELECT * FROM users where email1 = '$username' and pass1 = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo "<script>
  Swal.fire(
  'Error',
  'Email is already taken!',
  'error'
)</script>";
  //   session_start();
//   $_SESSION['employee_username1'] = $username;
//   $_SESSION['firstname1'] = $row['firstname'];
//   $_SESSION['role2'] = $row['role1'];
  // $_SESSION['employee_password'] = $password;
  // echo "<script>alert('".$username."');</script>";
//   echo "<script>window.location.replace('index.php');</script>";
} else {
    // echo "<script>alert('".$username.$password.$name."');</script>";
    $sql = "INSERT INTO users (name1, email1, pass1, noofwishlist, noofcollections ) 
    VALUES ('$name','$username','$password', 1, 2)";

    if ($conn->query($sql) === TRUE) {
               echo "<script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Registered...',
                    text: 'You have been registered successfully!',
                    allowOutsideClick: false
                  })
                  $( 'button.swal2-confirm' ).click(function() {
                    window.location.replace('./login.php');
                  });
                  </script>";
    }
}
// echo "<script>alert('".$username.$password."')</script>";

?>