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
                                    <?php
                                    try {
                                        include('../dbconfig.php');
                                        $sql = "SELECT * FROM `teacher_detail` WHERE `tid`=" . $_GET['id'];
                                        $result = $pdo->query($sql);
                                        if ($result->rowCount() > 0) {
                                            while ($row = $result->fetch()) { ?>
                                    <div class="card-body">
                                        <form action="update/update-teacher.php?id=<?php echo $row['tid']; ?>"
                                            method="POST" enctype="multipart/form-data">
                                            <h3>Personal Information</h3>
                                            <fieldset>

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Name.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['t_name']; ?>" name="tname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Father Name.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['fatherName']; ?>" name="fName"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Date Of Birth.</label>
                                                        <input type="date" class="form-control"
                                                            value="<?php echo $row['DOB']; ?>" name="tDOB" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">CNIC</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['CNIC']; ?>" name="tcnic" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Present Address.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['Address']; ?>" name="tAddress"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Phone No.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['phoneNo']; ?>" name="phoneNo"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Cell No.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['cellNo']; ?>" name="cellNo">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Email.</label>
                                                        <input type="email" class="form-control"
                                                            value="<?php echo $row['email']; ?>" name="temail">
                                                    </div>
                                                </div>
                                                <h3>Current Photo</h3>
                                                <img src="../admin/insert/<?php echo $row['t_image'] ?>" height="150"
                                                    width="150" style="border-style: double;" />
                                                <input type="hidden" name="previous"
                                                    value="<?php echo $row['t_image'] ?>" /><br><br>
                                                <label class="form-label">Upload New Image</label>
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
                                            <?php
                                            }
                                            // Free result set
                                            unset($result);
                                        } else {
                                            echo "No records matching your query were found.";
                                        }
                                    } catch (PDOException $e) {
                                        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                                    }

                                    // Close connection
                                    unset($pdo);
                                            ?>
                                            <div class="card-footer text-center">
                                                <input class="btn btn-warning" id="btn-submit" type="submit"
                                                    name="submit" value="Update Now">
                                                <a id="btn-progress"
                                                    class="btn btn-warning btn-progress disabled">progress</a>
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
    <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/sweetalert.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script src="croppie/croppie.js"></script>
    <?php require('../message.php'); ?>

    <script>
    $(document).ready(function() {
        $("#btn-progress").hide();
        $("form").submit(function() {
            $("#btn-submit").hide();
            $("#btn-progress").show();
        });
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
    });
    </script>
</body>


</html>