
<?php
include("../controllers/db.php");
$username = ucfirst($_POST['email1']);
$password = $_POST['password'];
$sql = "SELECT * FROM adminuser where email1 = '$username' and pass1 = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  session_start();
  $_SESSION['admin_username'] = $username;
  // $_SESSION['password'] = $password;
  echo "<script>window.location.replace('index.php');</script>";
} else {
  echo "<script>
  Swal.fire(
  'Error',
  'Username or Password is wrong!',
  'error'
)</script>";
}
// echo "<script>alert('".$username.$password."')</script>";

?>