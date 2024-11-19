<?php
include('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TSF | Dashboard</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon1.png' />
    <link rel="stylesheet" href="croppie/croppie.css">

</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <?php include('../admin/inc/nav.php'); ?>
            <?php include('../admin/inc/sidebar.php'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Add New Teacher</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="insert/add-new-teacher.php" method="POST"
                                            enctype="multipart/form-data">
                                            <h3>Personal Information</h3>
                                            <fieldset>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Name.</label>
                                                        <input type="text" class="form-control" name="tname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Father Name.</label>
                                                        <input type="text" class="form-control" name="fName" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Date Of Birth.</label>
                                                        <input type="date" class="form-control" name="tDOB" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">CNIC</label>
                                                        <input type="text" class="form-control" name="tcnic" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Present Address.</label>
                                                        <input type="text" class="form-control" name="tAddress"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Phone No.</label>
                                                        <input type="text" class="form-control" name="phoneNo" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Cell No.(optional)</label>
                                                        <input type="text" class="form-control" name="cellNo">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Email.(optional)</label>
                                                        <input type="email" class="form-control" name="temail">
                                                    </div>
                                                </div>
                                                <label class="form-label">Upload Image</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="images"
                                                        name="photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="images">Choose
                                                        Teacher Image</label>
                                                </div>
                                                <br><br>
                                                <input type="hidden" name="image" id="uploadimage">
                                                <div class="container" style="min-height:500px;">
                                                    <div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-4 text-center">
                                                                        <div id="upload-image"></div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <br />
                                                                        <a class="btn btn-success cropped_image"
                                                                            style="color: white;">Upload Image</a>
                                                                    </div>
                                                                    <div class="col-md-4 crop_preview">
                                                                        <div id="upload-image-i">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="card-footer text-center">
                                                <input class="btn btn-primary" id="btn-submit" type="submit"
                                                    name="submit" value="submit">
                                                <a id="btn-progress"
                                                    class="btn btn-primary btn-progress disabled">progress</a>
                                                <a href="index.php" class="btn btn-danger">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php include('../admin/inc/setting.php'); ?>

            </div>
            <?php include('../admin/inc/footer.php'); ?>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->

    <script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/form-wizard.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script src="croppie/croppie.js"></script>

    <script>
    $(document).ready(function() {
        $("#btn-progress").hide();
        // $("form").submit(function() {
        //     $("#btn-submit").hide();
        //     $("#btn-progress").show();
        // });
    });
    </script>
    <script>
    $(document).ready(function() {
        $image_crop = $('#upload-image').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });
        $('#images').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $image_crop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.cropped_image').on('click', function(ev) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                html = '<img src="' + response + '" />';
                $("#upload-image-i").html(html);
                $('#uploadimage').val(response);
            });
        });
        $(document).on("submit", "form", function(e) {
            if ($('#uploadimage').val() == "") {
                e.preventDefault();
                $('.cropped_image').click();
            } else {
                $("#btn-submit").hide();
                $("#btn-progress").show();
            }
        });
    });
    </script>
</body>

</html>