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
    <?php include('inc/link.php'); ?>
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
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
                        <!-- add content here -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="custom-select" id="classwise">
                                                    <option value="">Select Class</option>
                                                    <?php
                                                    try {
                                                        include('../dbconfig.php');
                                                        $sql = "SELECT * FROM class";
                                                        $result = $pdo->query($sql);
                                                        if ($result->rowCount() > 0) {
                                                            while ($row = $result->fetch()) {
                                                    ?>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Student Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>Image</th>
                                                    <th>Roll No</th>
                                                    <th>Name</th>
                                                    <th>Father Name</th>
                                                    <th>Class</th>
                                                    <th>Group</th>
                                                    <th>Session</th>
                                                    <th>Subjects</th>
                                                    <th>Fee</th>
                                                    <th>DOB</th>
                                                    <th>Nationality</th>
                                                    <th>Phone No</th>
                                                    <th>Cell No</th>
                                                    <th>Email</th>
                                                    <th>Present Add.</th>
                                                    <th>Permanent Add.</th>
                                                    <th>Relationship</th>
                                                    <th>Guardian Relation</th>
                                                    <!-- <th>CNIC</th>
                                                    <th>Employee</th>
                                                    <th>Designation</th>
                                                    <th>Orgnization</th>
                                                    <th>Business</th>
                                                    <th>Registration Date</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                try {
                                                    include('../dbconfig.php');
                                                    $sql = "SELECT * FROM student_detail WHERE `class`='" . $_GET["class"] . "' order by reg_id";
                                                    $result = $pdo->query($sql);
                                                    $counter = 0;
                                                    if ($result->rowCount() > 0) {
                                                        while ($row = $result->fetch()) { ?>
                                                            <tr>
                                                                <td><?php echo $counter += 1; ?></td>

                                                                <td>
                                                                    <img alt="Image" src="../admin/insert/<?php echo $row['std_image']; ?>" width="60px" height="60px">
                                                                </td>
                                                                <td><?php echo $row['reg_id']; ?></td>
                                                                <td>
                                                                    <?php echo $row['std_name']; ?>
                                                                </td>
                                                                <td><?php echo $row['std_fathername']; ?></td>
                                                                <td><?php echo getclassnamebyid($row['class']); ?></td>
                                                                <td><?php echo getgroupnamebyid($row['std_group']); ?></td>
                                                                <td><?php echo getsessionnamebyid($row['test_session']); ?></td>
                                                                <td><?php echo $row['subjects']; ?></td>
                                                                <td><?php echo $row['std_fee']; ?></td>
                                                                <td><?php echo $row['DOB']; ?></td>
                                                                <td><?php echo $row['std_nationality']; ?></td>
                                                                <td><?php echo $row['phoneNo']; ?></td>
                                                                <td><?php echo $row['cellNo']; ?></td>
                                                                <td><?php echo $row['E_Mail']; ?></td>
                                                                <td><?php echo $row['present_address']; ?></td>
                                                                <td><?php echo $row['permanent_address']; ?></td>
                                                                <td><?php echo $row['Relationship']; ?></td>
                                                                <td><?php echo $row['GuardianRelation']; ?></td>
                                                                <!-- <td><?php echo $row['CNIC']; ?></td>
                                                    <td><?php echo $row['Employee']; ?></td>
                                                    <td><?php echo $row['Designation']; ?></td>
                                                    <td><?php echo $row['Organization']; ?></td>
                                                    <td><?php echo $row['Business']; ?></td>
                                                    <td><?php
                                                            $dt = new DateTime($row['submission_date']);
                                                            echo $dt->format('Y-M-d'); ?></td> -->
                                                                <td>
                                                                    <a href="view-single-student.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                                    <a href="update-student.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                                                    <a class="btn btn-danger" href="delete/delete-student.php?id=<?php echo $row['id']; ?>"><i class="fas fa-trash-alt"></i></a>
                                                                </td>


                                                            </tr>
                                                <?php
                                                        }
                                                        // Free result set
                                                        unset($result);
                                                    }
                                                } catch (PDOException $e) {
                                                    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                                                }

                                                // Close connection
                                                unset($pdo);
                                                ?>
                                            </tbody>
                                        </table>
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
    <?php include('inc/script.php'); ?>
    <!-- Page Specific JS File -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <?php require('../message.php'); ?>
    <!-- Template JS File -->
    <script>
        $(document).ready(function() {
            var uri = window.location.toString();
            if (uri.indexOf("?") > 0) {
                var clean_uri = uri.substring(0, uri.indexOf("="));
                window.history.replaceState({}, document.title, clean_uri);
            }
        });
        $(document).ready(function() {
            var urlold = document.location.href;
            $('#classwise').on('change', function() {
                var selected = document.getElementById('classwise').value;
                var url = urlold + "=" + selected;
                document.location = url;
            });
        });
    </script>
</body>

</html>