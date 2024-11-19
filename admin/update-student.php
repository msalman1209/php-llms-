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
                                        <h4>Add New Student</h4>
                                    </div>
                                    <?php
                                    try {
                                        include('../dbconfig.php');
                                        $sql = "SELECT * FROM `student_detail` WHERE `id`=" . $_GET['id'];
                                        $result = $pdo->query($sql);
                                        if ($result->rowCount() > 0) {
                                            while ($row = $result->fetch()) { ?>
                                    <div class="card-body">
                                        <form action="update/update-student.php?id=<?php echo $row['id']; ?>"
                                            method="POST" enctype="multipart/form-data">
                                            <h3>Personal Information</h3>
                                            <fieldset>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Roll No.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['reg_id']; ?>" name="regid" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Student Name.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['std_name']; ?>" name="stdName"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Father Name.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['std_fathername']; ?>"
                                                            name="fatherName" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Date Of Birth.</label>
                                                        <input type="date" class="form-control"
                                                            value="<?php echo $row['DOB']; ?>" name="DOB" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Nationality.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['std_nationality']; ?>"
                                                            name="Nationality" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Present Address.</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['present_address']; ?>"
                                                            name="presentAddress" required>
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
                                                            value="<?php echo $row['E_Mail']; ?>" name="email">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Permanent Address (if
                                                            different)</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $row['permanent_address']; ?>"
                                                            name="permanentAddress">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3>Academic Information</h3>
                                            <fieldset>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Subjects</label>
                                                        <input type="text" name="subjects"
                                                            value="<?php echo $row['subjects']; ?>" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Fee</label>
                                                        <input type="number" name="stdfee" min="0" max="100000"
                                                            value="<?php echo $row['std_fee']; ?>" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="relation">
                                                            <option value="Parent">Parent</option>
                                                            <option value="Guardian">Guardian</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Guardian Relation</label>
                                                        <input type="text" name="GuardianRelation"
                                                            value="<?php echo $row['GuardianRelation']; ?>"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">CNIC</label>
                                                        <input type="text" name="cnic"
                                                            value="<?php echo $row['CNIC']; ?>" class="form-control"
                                                            placeholder="xxxxx-xxxxxxx-x">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectClass">
                                                            <option value="" selected>Select Class</option>

                                                            <?php
                                                                        try {
                                                                            include('../dbconfig.php');
                                                                            $sqlclass = "SELECT * FROM class";
                                                                            $resultclass = $pdo->query($sqlclass);
                                                                            if ($resultclass->rowCount() > 0) {
                                                                                while ($rowclass = $resultclass->fetch()) {
                                                                        ?>
                                                            <option value="<?php echo $rowclass['cid']; ?>"
                                                                <?php echo ($rowclass['cid'] == $row['class']) ? 'selected' : ''; ?>>
                                                                <?php echo $rowclass['class_name']; ?>
                                                            </option>
                                                            <?php
                                                                                }
                                                                                // Free result set
                                                                                unset($resultclass);
                                                                            } else {
                                                                                echo "No records matching your query were found.";
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            die("ERROR: Could not able to execute $sqlclass. " . $e->getMessage());
                                                                        }

                                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectGroup">
                                                            <option value="" selected>Select Group</option>
                                                            <?php
                                                                        try {
                                                                            include('../dbconfig.php');
                                                                            $sqlgroup = "SELECT * FROM stdgroup";
                                                                            $resultgroup = $pdo->query($sqlgroup);
                                                                            if ($resultgroup->rowCount() > 0) {
                                                                                while ($rowgroup = $resultgroup->fetch()) {
                                                                        ?>
                                                            <option value="<?php echo $rowgroup['gid'];
                                                                                                    ?>"
                                                                <?php echo ($rowgroup['gid'] == $row['std_group']) ? 'selected' : ''; ?>>
                                                                <?php echo $rowgroup['g_name'];
                                                                                        ?>
                                                            </option>
                                                            <?php
                                                                                }
                                                                                //Free result set
                                                                                unset($resultgroup);
                                                                            } else {
                                                                                echo "No records matching your query were found.";
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            die("ERROR: Could not able to execute $sqlgroup. " . $e->getMessage());
                                                                        }

                                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectSession">
                                                            <option value="" selected>Select Session</option>
                                                            <?php
                                                                        try {
                                                                            include('../dbconfig.php');
                                                                            $sqlsession = "SELECT * FROM stdsession";
                                                                            $resultsession = $pdo->query($sqlsession);
                                                                            if ($resultsession->rowCount() > 0) {
                                                                                while ($rowsession = $resultsession->fetch()) {
                                                                        ?>
                                                            <option value="<?php echo $rowsession['sid'];
                                                                                                    ?>"
                                                                <?php echo ($rowsession['sid'] == $row['test_session']) ? 'selected' : ''; ?>>
                                                                <?php echo $rowsession['session_name'];
                                                                                        ?>
                                                            </option>
                                                            <?php
                                                                                }
                                                                                // Free result set
                                                                                unset($resultsession);
                                                                            } else {
                                                                                echo "No records matching your query were found.";
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            die("ERROR: Could not able to execute $sqlsession. " . $e->getMessage());
                                                                        }

                                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectEmployee">
                                                            <option value="" selected>Select Employee</option>
                                                            <option value="Govt"
                                                                <?php echo ($row['Employee'] == 'Govt') ? 'selected' : ''; ?>>
                                                                Govt</option>
                                                            <option value="Private"
                                                                <?php echo ($row['Employee'] == 'Private') ? 'selected' : ''; ?>>
                                                                Private</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Designation</label>
                                                        <input type="text" name="Designation"
                                                            value="<?php echo $row['Designation']; ?>"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Organization</label>
                                                        <input type="text" name="Organization"
                                                            value="<?php echo $row['Organization']; ?>"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Business</label>
                                                        <input type="text" name="Business"
                                                            value="<?php echo $row['Business']; ?>"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <h3>Current Photo</h3>
                                                <img src="../admin/insert/<?php echo $row['std_image'] ?>" height="150"
                                                    width="150" style="border-style: double;" />
                                                <input type="hidden" name="previous"
                                                    value="<?php echo $row['std_image'] ?>" /><br><br>
                                                <label class="form-label">Upload New Image</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="photo"
                                                        id="images" value="">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
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

                                                                        <!-- <input type="file" id="images"> -->
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
                                            <h3>Terms &amp; Conditions</h3>
                                            <fieldset>
                                                <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                                <label for="acceptTerms-2">I agree with the Terms and
                                                    Conditions.</label>
                                            </fieldset>

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