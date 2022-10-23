<?php
include("../../controllers/db.php");
// session_start();
// if(empty($_SESSION['employee_username1'])){
//   echo "<script>window.location.replace('login.php');</script>";
// }

$Wrestler = $_POST['Wrestler'];
$SKU = $_POST['SKU'];
$Brand = $_POST['Brand'];
$Line = $_POST['Line'];
$Subline = $_POST['Subline'];
$Series = $_POST['Series'];
$Year = $_POST['Year'];
    $sql = "CALL create_wrestling_figure('$Wrestler','$SKU','$Brand','$Line','$Subline','$Series','$Year')";
    // $result = $conn1->query($sql);
    // !$conn1 -> query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Registered...',
          text: 'New Wrestling Figure Added Successfully!',
          allowOutsideClick: false
        })
        $( 'button.swal2-confirm' ).click(function() {
          window.location.reload();
        });
        </script>";
      }
    //   echo("Error description: " . $conn -> error);
    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    //     }
    // }

// }
// echo "<script>alert('".$username.$password."')</script>";

?>