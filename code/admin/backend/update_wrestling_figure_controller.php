<?php
include("../../controllers/db.php");
// session_start();
// if(empty($_SESSION['employee_username1'])){
//   echo "<script>window.location.replace('login.php');</script>";
// }
$id_of_wrestler = $_POST['id_of_wrestler'];
$Wrestler = $_POST['Wrestler'];
$SKU = $_POST['SKU'];
$Brand = $_POST['Brand'];
$Line = $_POST['Line'];
$Subline = $_POST['Subline'];
$Figure = $_POST['Figure'];
$Series = $_POST['Series'];
$Year = $_POST['Year'];
    $sql = "CALL update_wrestling_figure('$Wrestler','$SKU','$Brand','$Line','$Subline','$Figure','$Year','$Series', '$id_of_wrestler')";
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
            url: './backend/all_wrestling_figures.php',
            success: function (result) {
                $('#showhere').html(result);
                document.getElementById('loader1').style.visibility = 'hidden';
            }
        });
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