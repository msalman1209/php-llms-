<?php
include('auth.php');
include('inc/function.php');
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TSF | Dashboard</title>
    <!-- General CSS Files -->
    <?php include('inc/link.php'); ?>
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <?php include('../admin/inc/nav.php'); ?>
            <?php include('../admin/inc/sidebar.php'); ?>

            <?php
            try {
                include('../dbconfig.php');
                $sql = "SELECT * FROM `student_detail` WHERE `id`='" . $_GET["id"] . "'";
                $result = $pdo->query($sql);
                $counter = 0;
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch()) { ?>


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row mt-sm-4">
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card author-box">
                                    <div class="card-body">
                                        <div class="author-box-center">
                                            <img alt="image" src="../admin/insert/<?php echo $row['std_image']; ?>"
                                                class="rounded-circle author-box-picture">
                                        </div>
                                        <div class="text-left">
                                            <div class="author-box-description">
                                                <h6>Roll No: <?php echo $row['reg_id']; ?></h6>
                                            </div>
                                            <div class="author-box-description">
                                                <h6>Name: <?php echo $row['std_name']; ?></h6>
                                            </div>
                                            <div class="author-box-description">
                                                <h6>F.Name: <?php echo $row['std_fathername']; ?></h6>
                                            </div>
                                            <div class="author-box-description">
                                                <h6>Class: <?php echo getclassnamebyid($row['class']); ?></h6>
                                            </div>
                                            <div class="author-box-description">
                                                <h6>Group: <?php echo getgroupnamebyid($row['std_group']); ?></h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="card">
                                    <div class="padding-20">

                                        <div class="tab-content tab-bordered" id="myTab3Content">

                                            <div class="tab-pane fade show active" id="settings" role="tabpanel"
                                                aria-labelledby="profile-tab2">
                                                <form method="post" class="needs-validation">
                                                    <div class="card-header">
                                                        <h4>Student Detail</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>DOB:&ensp;<?php echo $row['DOB']; ?></h6>
                                                                <h6>Session:&ensp;
                                                                    <?php echo getsessionnamebyid($row['test_session']); ?>
                                                                </h6>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>Subjects:&ensp;<?php echo $row['subjects']; ?></h6>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>Fee:&ensp;<?php echo $row['std_fee']; ?></h6>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>Nationality:&ensp;<?php echo $row['std_nationality']; ?>
                                                                </h6>
                                                                <h6>Whatsapp:&ensp;<?php echo $row['phoneNo']; ?></h6>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>E-Mail:&ensp;<?php echo $row['E_Mail'] == '' ? 'no email provided' : $row['E_Mail']; ?>
                                                                </h6>
                                                                <h6>Mobile No: <?php echo $row['cellNo']; ?></h6>

                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>Present Address:
                                                                    <?php echo $row['present_address']; ?>
                                                                </h6>
                                                                <h6>Permanent Address:
                                                                    <?php echo $row['permanent_address']; ?>
                                                                </h6>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>Relationship: <?php echo $row['Relationship']; ?>
                                                                </h6>
                                                                <h6>Guardian Relation:
                                                                    <?php echo $row['GuardianRelation']; ?>
                                                                </h6>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>CNIC:
                                                                    <?php echo $row['CNIC'] == '' ? 'Blank' : $row['CNIC']; ?>
                                                                </h6>
                                                                <h6>Registration Date:
                                                                    <?php
                                                                                $dt = new DateTime($row['submission_date']);
                                                                                echo $dt->format('Y-M-d'); ?></h6>
                                                            </div>
                                                            <div class="form-group col-md-6 col-12">
                                                                <h6>Employee:
                                                                    <?php echo $row['Employee'] == '' ? 'Blank' : $row['Employee']; ?>
                                                                </h6>
                                                                <h6>Designation:
                                                                    <?php echo $row['Designation'] == '' ? 'Blank' : $row['Designation']; ?>
                                                                </h6>
                                                                <h6>Organization:
                                                                    <?php echo $row['Organization'] == '' ? 'Blank' : $row['Organization']; ?>
                                                                </h6>
                                                                <h6>Business:
                                                                    <?php echo $row['Business'] == '' ? 'Blank' : $row['Business']; ?>
                                                                </h6>
                                                            </div>

                                                        </div>
                                                        <a href="update-student.php?id=<?php echo $row['id']; ?>"
                                                            class="btn btn-warning"><i
                                                                class="fas fa-pencil-alt"></i>&nbsp;Update</a>
                                                        <a class="btn btn-danger"
                                                            href="delete/delete-student.php?id=<?php echo $row['id']; ?>"><i
                                                                class="fas fa-trash-alt"></i>&nbsp;Delete</a>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
                <?php include('../admin/inc/setting.php'); ?>

            </div>
            <?php include('../admin/inc/footer.php'); ?>
        </div>
    </div>
    <?php include('inc/script.php'); ?>

</body>


</html>