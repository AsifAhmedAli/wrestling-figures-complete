<?php
include("../../controllers/db.php");
  $id = $_POST['imagesuploadform'];
  $id = (int)$id;
      // echo "<script>alert('".$id."')</script>";
  extract($_POST);
  // $error=array();
  $countercheck = 0;
  // echo "sadfs";
//   $extension=array("jpeg","jpg","png","gif");
  foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
      // echo "sadfs";
      $file_name=str_replace(' ', '', $_FILES["files"]["name"][$key]);
      // echo "<script>alert('".$file_name."')</script>";
      $file_tmp=$_FILES["files"]["tmp_name"][$key];
      $ext=pathinfo($file_name,PATHINFO_EXTENSION);
      
      // echo $file_name;
    //   if(in_array($ext,$extension)) {
          if(!file_exists("../../../wrestler_images/".$file_name)) {
            $file_name = str_replace("'", '', $file_name);
            // echo "<script>alert('".$file_name."')</script>";
              if(move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../../../wrestler_images/".$file_name)){
                $sql = "CALL add_images_of_wrestler('$id','$file_name', 'no')";
                
                if ($conn->query($sql) === TRUE) {
                  $countercheck++;
                }
                                  echo("Error description: " . $conn -> error);
                // echo $file_name;
              }
          }
          else {
              $filename=basename($file_name,$ext);
              $filename=$filename.time().".".$ext;
              
              $newFileName = str_replace(' ', '', $filename);
            $newFileName = str_replace("'", '', $newFileName);
            // echo "<script>alert('".$newFileName."')</script>";
              // echo $newFileName;
              if(move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../../../wrestler_images/".$newFileName)){
                $sql = "CALL add_images_of_wrestler('$id','$newFileName','no')";
                if ($conn->query($sql) === TRUE) {
                  $countercheck++;
                }

                // if (!$conn -> query($sql)) {
                  echo("Error description: " . $conn -> error);
                // }
                                // echo $newFileName;
              }
          }
  }
  if($countercheck > 0){
    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Done...',
      text: 'Images have been uploaded!',
      allowOutsideClick: false
    })
    $( 'button.swal2-confirm' ).click(function() {
      location.reload();
    });
    </script>";
  }
    // echo "<script>alert('".$id."')</script>";

    ?>