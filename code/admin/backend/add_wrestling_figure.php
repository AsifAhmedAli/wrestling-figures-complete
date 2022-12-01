<?php
include("../../controllers/db.php");

?>
<div>
    <h3 class="text-center">
        Add Wrestling Figure
    </h3>
    <form id="addwrestler">
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
        <input  type="text" id="Wrestler" name="Wrestler" class="form-control" placeholder="Enter Wrestler">
        <input  type="text" id="SKU" name="SKU" class="form-control" placeholder="Enter SKU">
        </div>
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
        <input  type="text" id="Brand" name="Brand" class="form-control" placeholder="Enter Brand">   
        <input  type="text" id="Line" name="Line" class="form-control" placeholder="Enter Line">
        </div>
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
        <input  type="text" id="Subline" name="Subline" class="form-control" placeholder="Enter Subline">
        <input  type="text" id="Series" name="Series" class="form-control" placeholder="Enter Series">
            
        </div>
        <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
            <input  type="text" id="Year" name="Year" class="form-control" placeholder="Enter Year">
            <input  type="text" id="Figure" name="Figure" class="form-control" placeholder="Enter Figure">
        </div>
            <!-- <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
                <input type="file" class="form-control" multiple name="files[]" id="signleao">
            </div> -->
        <!-- <div class="mt-3"> -->
            <!-- <button type="submit" class="btn btn-primary">Upload</button> -->
        <!-- </div> -->
        <!-- <div class="input-group mb-3 col-md-6 mt-4 mx-auto">
    <input type="text" id="username" class="form-control" placeholder="Enter Line">
    <input type="text" id="password" class="form-control" placeholder="Enter Subline">
</div> -->

        <div class="input-group-append">
            <button class="btn btn-outline-secondary mx-auto" type="submit">Add Now</button>
        </div>
    </form>
</div>
<hr class="my-5" style="border-top: 1px solid rgba(0,0,0,0.5) !important;">
<div>
    <h3 class="text-center">
        Bulk Upload
    </h3>
<form id="excelsheet">
<div class="input-group mb-3 col-md-6 mt-4 mx-auto">
    <input required type="file" class="form-control" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
</div>

<div class="input-group-append">
            <button class="btn btn-outline-secondary mx-auto" type="submit">Add Now</button>
        </div>
</form>
</div>
<div id="div12"></div>
<script>
    var request;

    $("#addwrestler").submit(function (event) {
        // alert(document.getElementById("imagesuploadform").value);
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var formData = new FormData(this);
        document.getElementById("loader1").style.visibility = "visible";
        $.ajax({
            type: "post",
            data: formData,
            url: "./backend/add_wrestling_figure_controller.php",
            success: function (result) {
                $("#div12").html(result);
                document.getElementById("loader1").style.visibility = "hidden";
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });




    $("#excelsheet").submit(function (event) {
        // alert(document.getElementById("imagesuploadform").value);
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var formData = new FormData(this);
        document.getElementById("loader1").style.visibility = "visible";
        $.ajax({
            type: "post",
            data: formData,
            url: "./backend/excel_bulk_upload_controller.php",
            success: function (result) {
                $("#div12").html(result);
                document.getElementById("loader1").style.visibility = "hidden";
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>