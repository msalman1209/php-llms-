<?php
include('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
                                    <div class="card-body">
                                        <form action="insert/add-new-student.php" method="POST"
                                            enctype="multipart/form-data">
                                            <h3>Personal Information</h3>
                                            <fieldset>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Roll No.</label>
                                                        <input type="text" id="registration" class="form-control"
                                                            name="regid" required>
                                                    </div>
                                                    <div id="RegMessage">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Student Name.</label>
                                                        <input type="text" class="form-control" name="stdName" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Father Name.</label>
                                                        <input type="text" class="form-control" name="fatherName"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Date Of Birth.</label>
                                                        <input type="date" class="form-control" name="DOB" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Nationality.</label>
                                                        <input type="text" class="form-control" name="Nationality"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Present Address.</label>
                                                        <input type="text" class="form-control" name="presentAddress"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Phone No.</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter no i.e 9230xxxxxxxx" name="phoneNo"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Cell No.</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter no i.e 9230xxxxxxxx" name="cellNo">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Email.</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter student email" name="email">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Permanent Address (if
                                                            different)</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter permanent address"
                                                            name="permanentAddress">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <h3>Academic Information</h3>
                                            <fieldset>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Subjects</label>
                                                        <input type="text" name="subjects" class="form-control"
                                                            placeholder="For i.e computer, physics, math, computer, chemistery"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Fee</label>
                                                        <input type="number" min="0" max="100000" name="stdfee"
                                                            class="form-control" placeholder="Enter Student Fee"
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
                                                        <input type="text" name="GuardianRelation" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">CNIC</label>
                                                        <input type="text" name="cnic" class="form-control"
                                                            placeholder="xxxxx-xxxxxxx-x">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectClass" required>
                                                            <option value="" selected>Select Class</option>

                                                            <?php
                                                            try {
                                                                include('../dbconfig.php');
                                                                $sql = "SELECT * FROM class";
                                                                $result = $pdo->query($sql);
                                                                if ($result->rowCount() > 0) {
                                                                    while ($row = $result->fetch()) { ?>
                                                            <option value="<?php echo $row['cid']; ?>">
                                                                <?php echo $row['class_name']; ?>
                                                            </option>
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
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectGroup" required>
                                                            <option value="" selected>Select Group</option>
                                                            <?php
                                                            try {
                                                                include('../dbconfig.php');
                                                                $sql = "SELECT * FROM stdgroup";
                                                                $result = $pdo->query($sql);
                                                                if ($result->rowCount() > 0) {
                                                                    while ($row = $result->fetch()) { ?>
                                                            <option value="<?php echo $row['gid']; ?>">
                                                                <?php echo $row['g_name']; ?>
                                                            </option>
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
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectSession" required>
                                                            <option value="" selected>Select Session</option>
                                                            <?php
                                                            try {
                                                                include('../dbconfig.php');
                                                                $sql = "SELECT * FROM stdsession";
                                                                $result = $pdo->query($sql);
                                                                if ($result->rowCount() > 0) {
                                                                    while ($row = $result->fetch()) { ?>
                                                            <option value="<?php echo $row['sid']; ?>">
                                                                <?php echo $row['session_name']; ?>
                                                            </option>
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
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="custom-select" name="SelectEmployee">
                                                            <option value="" selected>Select Employee</option>
                                                            <option value="Govt">Govt</option>
                                                            <option value="Private">Private</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Designation (optional)</label>
                                                        <input type="text" name="Designation" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Organization (optional)</label>
                                                        <input type="text" name="Organization" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Business (optional)</label>
                                                        <input type="text" name="Business" class="form-control">
                                                    </div>
                                                </div>
                                                <label class="form-label">Upload Image</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="images"
                                                        name="photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="images">Choose
                                                        Student Image</label>
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

        $('#registration').on('change', function() {
            var name = $('#registration').val();
            if (name != "") {
                $.ajax({
                    url: "validRegistration.php",
                    type: "POST",
                    data: {
                        name: name,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        switch (dataResult.statusCode) {
                            case 200:
                                var displayDiv = document.getElementById('RegMessage');
                                displayDiv.style.color = "#2B7A0B";
                                displayDiv.innerHTML =
                                    "<div>Valid! student roll no. No student exist on this roll no.</div>";
                                break;
                            case 201:
                                var displayDiv = document.getElementById('RegMessage');
                                displayDiv.style.color = 'red';
                                displayDiv.innerHTML =
                                    "<div>Invalid! student roll no. Student already exist On this roll no.</div>";
                                break;
                        }
                    }
                });
            }
        });
    });
    </script>

</body>


</html>