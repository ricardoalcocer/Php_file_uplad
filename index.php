<?php 
    @ini_set( 'upload_max_size' , '2560M' );
    @ini_set( 'post_max_size', '3000M');
    @ini_set( 'max_execution_time', '3600' );
    @ini_set( 'max_input_time', '3600' );

    $uploadFolder = "files/";

    if (!is_dir($uploadFolder)) {
        mkdir("$uploadFolder", 0777, true);
    }

    if (!empty($_FILES['file'])){
        foreach ($_FILES['file']['name'] as $key => $name) {
            if($_FILES['file']['error'][$key] == 0 && move_uploaded_file($_FILES['file']['tmp_name'][$key],"{$uploadFolder}/{$name}")){
                $uploaded[] = $name;
            }
        }
        if (!empty($_POST['ajax'])){
            die(json_encode(($uploaded)));
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            #upload_progress {display: none};
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="uploader.js"></script>
    </head>
    <body>
        
            <form method="POST" id="fileInput" action="" enctype="multipart/form-data" class="form-group">
            <div class="card">
                <div class="card-header">File Uploader</div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group pt-4">                
                                    <div class="progress">
                                        <div id="progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 pt-3 text-right">
                                <input type="submit" id="submit" value="Upload" style="width: 100%"/>
                            </div>
                        </div>
                   
            </div>
            </div>
            </form>
        


        <div id="upload_progress"></div>
        <script>
            window.onload = function(){
                // Add the following code if you want the name of the file appear on select
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            }
        </script>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>