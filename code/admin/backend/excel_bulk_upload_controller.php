<?php
require_once('../../../vendor/autoload.php');

use Phppot\DataSource;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
// class figure{
//     public $SKU;
//     public $Brand;
//     public $Line;
//     public $Subline;
//     public $Series;
//     public $Wrestler;
//     public $Year;
//     // public $Category;
//     public $images;
//     // public $SKU;
//     // public $SKU;
// }
// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');

// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');
include("../../controllers/db.php");

// echo "asdf";
// $id = $_POST["mynaawe"];
// $id = (int)$id;  
function clean($str)
{
    $res = str_replace(array('\'', '"', ',', ';', '<', '>'), ' ', $str);

    // Returning the result
    return $res;
}
// function clean($string) {
//     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

//     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
//  }
$t = time();
// echo($t . "<br>");
$targetPath = "../../../excel_sheets/" . $t . $_FILES['excel']['name'];
if (move_uploaded_file($_FILES['excel']['tmp_name'], $targetPath)) {
    //   echo "moved";
};
// count row number 
$row = 0;
// add you row number for skip 
// hear we pass 1st row for skip in csv 
$skip_row_number = array("1");

// open csv file 
$csv_file = fopen($targetPath, "r");

while (($data = fgetcsv($csv_file, 1000, ",")) !== FALSE) {
    $row++;
    // count total filed of csv row 
    $num = count($data);
    // check row for skip row 	
    if (in_array($row, $skip_row_number)) {
        continue;
        // skip row of csv
    } else {
        // print row number and total filed of csv
        // echo "<p> $num fields in line $row: <br /></p>\n";
        $csv_data[] = $data;
        // add data in to array 
    }
}
// close csv file 
// $new_figure = new figure;
fclose($csv_file);
$counter = 1;
$i = 0;
$error_rows = [];
for (; $i < count($csv_data); $i++) {
    for ($j = 0; $j < count($csv_data[$i]); $j++) {
        // echo $csv_data[$i][$j]."<br>";
        switch ($j) {
            case 0: {
                    $SKU1 = $csv_data[$i][$j];
                    $SKU = clean($SKU1);
                    // echo "<script>console.log('".$SKU."');</script>";
                    break;
                }
            case 1: {
                    $Brand1 = $csv_data[$i][$j];
                    $Brand = clean($Brand1);
                    // echo "<script>console.log('".$Brand."');</script>";
                    break;
                }
            case 2: {
                    $Line1 = $csv_data[$i][$j];
                    $Line = clean($Line1);
                    // echo "<script>console.log('".$Line."');</script>";
                    break;
                }
            case 3: {
                    $Subline1 = $csv_data[$i][$j];
                    $Subline = clean($Subline1);
                    // echo "<script>console.log('".$Subline."');</script>";
                    break;
                }
            case 4: {
                    $Series1 = $csv_data[$i][$j];
                    $Series = clean($Series1);
                    // echo "<script>console.log('".$Series."');</script>";
                    // echo "<script>console.log('".$Series."');</script>";
                    break;
                }
            case 5: {
                    $figure1 = $csv_data[$i][$j];
                    $figure = clean($figure1);
                    // echo "<script>console.log('".$figure."');</script>";
                    // echo "<script>console.log('".$figure."');</script>";
                    break;
                }
            case 6: {
                    $Year1 = $csv_data[$i][$j];
                    $Year = clean($Year1);
                    // echo "<script>console.log('".$Year."');</script>";
                    // echo "<script>console.log('".$Year."');</script>";
                    break;
                }
            case 8: {
                    $Wrestler1 = $csv_data[$i][$j];
                    $Wrestler = clean($Wrestler1);
                    // echo "<script>console.log('".$Wrestler."');</script>";
                    // echo "<script>console.log('".$Wrestler."');</script>";
                    break;
                }
            case 9: {
                    $images1 = $csv_data[$i][$j];
                    $images = clean($images1);
                    // echo "<script>console.log('".$images."');</script>";
                    //   echo "<script>console.log('".$images."');</script>";
                    break;
                }
            default:
                # code...
                break;
        }
    }
    $counter++;
    // echo $counter;
    // echo $SKU." ".$Brand." ".$Line." ".$Subline." ".$Series." ".$Wrestler." ".$Year." ".$images."<br>";
    $sql = "CALL create_wrestling_figure('$Wrestler','$SKU','$Brand','$Line', '$figure','$Subline','$Year','$Series')";
    // $result = $conn1->query($sql);
    // !$conn1 -> query($sql);
    if ($conn->query($sql) === TRUE) {

        $conn->next_result();
        $sql1 = "CALL biggest_id_of_wrestler_figures()";
        // $result = $conn1->query($sql);
        // !$conn1 -> query($sql);
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            // output data of each row
            while ($row1 = $result1->fetch_assoc()) {
                $id = $row1['maxid'];
                //   echo "<script>console.log('".$id."');</script>";
            }
        }
        $result1->close();
        $conn->next_result();
        $sql2 = "CALL add_images_of_wrestler('$id','$images', 'yes')";
        if ($conn->query($sql2) === TRUE) {
        }
    } else {
        $error = "yes";
        array_push($error_rows, $counter . " => Name: " . $Wrestler);
    }
}
if ($error == "yes") {

    echo "<script>$('#exampleModalCenter').modal('show')</script>";
} else {
    echo "<script>
                    Swal.fire({
                      icon: 'success',
                      title: 'Registered...',
                      text: 'New Wrestling Figures Added Successfully with no errors!',
                      allowOutsideClick: false
                    })
                    $( 'button.swal2-confirm' ).click(function() {
                      window.location.reload();
                    });
                    </script>";
}
?>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Success with Errors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 text-center">
                    <h5 class="text-center">
                        You have faced errors in the following rows:
                        <ol class="text-left">
                            <?php
                            foreach ($error_rows as $errors_numbers) {
                                echo "<li>" . $errors_numbers . "</li>";
                            }
                            ?>
                        </ol>
                    </h5>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>