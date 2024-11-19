<?php
include('auth.php');
include('inc/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

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
                                <div class="card-header">
                                    <h4>Present Students</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
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
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                try {
                                                    include('../dbconfig.php');
                                                    date_default_timezone_set('Asia/Karachi');
                                                    $runningdate = date('Y-m-d');
                                                    $sql = "SELECT *,DATE_FORMAT(`attedance_date`, '" . "%M %d %Y" . "') as indate,TIME_FORMAT(`attedance_date`, '" . "%T" . "') as intime FROM daily_attendance as da,student_detail as sa WHERE da.reg_id = sa.reg_id and da.attendace_status=1 and DATE_FORMAT(`attedance_date`,'%Y-%m-%d') LIKE '$runningdate' order by intime DESC";
                                                    $result = $pdo->query($sql);
                                                    $counter = 0;
                                                    if ($result->rowCount() > 0) {
                                                        while ($row = $result->fetch()) { ?>
                                                <tr>
                                                    <td><?php echo $counter += 1; ?></td>
                                                    <td>
                                                        <img alt="Image"
                                                            src="../admin/insert/<?php echo $row['std_image']; ?>"
                                                            width="40" height="40">
                                                    </td>
                                                    <td><?php echo $row['reg_id']; ?></td>
                                                    <td>
                                                        <?php echo $row['std_name']; ?>
                                                    </td>
                                                    <td><?php echo $row['std_fathername']; ?></td>
                                                    <td><?php echo getclassnamebyid($row['class']); ?></td>
                                                    <td><?php echo getgroupnamebyid($row['std_group']); ?></td>
                                                    <td><?php echo $row['indate']; ?></td>
                                                    <td><?php echo $row['intime']; ?></td>
                                                    <td>
                                                        <div class="badge badge-success">
                                                            <?php echo $row['attendace_status'] == 1 ? 'Present' : ''; ?>
                                                        </div>
                                                    </td>
                                                </tr>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Absent Students</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
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
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                try {
                                                    include('../dbconfig.php');
                                                    date_default_timezone_set('Asia/Karachi');
                                                    $runningdate = date('Y-m-d');
                                                    $sql = "SELECT * FROM `student_detail` WHERE `reg_id` NOT IN (SELECT sd.reg_id FROM student_detail as sd, daily_attendance as da WHERE sd.reg_id=da.reg_id and da.attendace_status IN(1,0,3) and DATE_FORMAT(`attedance_date`,'%Y-%m-%d') LIKE '$runningdate')";
                                                    $result = $pdo->query($sql);
                                                    $counter = 0;
                                                    if ($result->rowCount() > 0) {
                                                        while ($row = $result->fetch()) { ?>
                                                <tr>
                                                    <td><?php echo $counter += 1; ?></td>
                                                    <td>
                                                        <img alt="Image"
                                                            src="../admin/insert/<?php echo $row['std_image']; ?>"
                                                            width="40" height="40">
                                                    </td>
                                                    <td><?php echo $row['reg_id']; ?></td>
                                                    <td>
                                                        <?php echo $row['std_name']; ?>
                                                    </td>
                                                    <td><?php echo $row['std_fathername']; ?></td>
                                                    <td><?php echo getclassnamebyid($row['class']); ?></td>
                                                    <td><?php echo getgroupnamebyid($row['std_group']); ?></td>
                                                    <td>
                                                        <?php echo "<div class=" . '"badge badge-danger"' . ">Absent Not Mark</div>"; ?>

                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-3" role="group"
                                                            aria-label="Basic example">
                                                            <a href="attendance/mark-absent.php?aid=<?php echo $row['reg_id']; ?>"
                                                                class="btn btn-danger">Mark
                                                                Absent</a>
                                                            <a href="attendance/mark-leave.php?lid=<?php echo $row['reg_id']; ?>"
                                                                class="btn btn-warning">On
                                                                Leave</a>

                                                        </div>
                                                    </td>
                                                </tr>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Absent / Leave Marked Students</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
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
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                try {
                                                    include('../dbconfig.php');
                                                    date_default_timezone_set('Asia/Karachi');
                                                    $runningdate = date('Y-m-d');
                                                    $sql = "SELECT * FROM student_detail as sd, daily_attendance as da WHERE sd.reg_id=da.reg_id and da.attendace_status != 1 and DATE_FORMAT(`attedance_date`,'%Y-%m-%d') LIKE '$runningdate'";
                                                    $result = $pdo->query($sql);
                                                    $counter = 0;
                                                    if ($result->rowCount() > 0) {
                                                        while ($row = $result->fetch()) { ?>
                                                <tr>
                                                    <td><?php echo $counter += 1; ?></td>
                                                    <td>
                                                        <img alt="Image"
                                                            src="../admin/insert/<?php echo $row['std_image']; ?>"
                                                            width="40" height="40">
                                                    </td>
                                                    <td><?php echo $row['reg_id']; ?></td>
                                                    <td>
                                                        <?php echo $row['std_name']; ?>
                                                    </td>
                                                    <td><?php echo $row['std_fathername']; ?></td>
                                                    <td><?php echo getclassnamebyid($row['class']); ?></td>
                                                    <td><?php echo getgroupnamebyid($row['std_group']); ?></td>
                                                    <td>
                                                        <?php
                                                                    switch ($row['attendace_status']) {
                                                                        case 0:
                                                                            echo "<div class=" . '"badge badge-danger"' . ">Absent Marked</div>";
                                                                            break;
                                                                        case 3:
                                                                            echo "<div class=" . '"badge badge-secondary"' . ">Leave Marked</div>";
                                                                            break;
                                                                        default:
                                                                            echo "<div class=" . '"badge badge-danger"' . ">Absent</div>";
                                                                    }
                                                                    ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-3" role="group"
                                                            aria-label="Basic example">
                                                            <a href="message/index.php?msg=*Attendance Alert.* <?php echo $row['std_name'] . " is Absent From Academy.\\n*TSF Academy Of Science And Arts*\\n*Address: Chandni Chowk 428-C GM Abad FSD.*\\n*Mobile No: +923062736167*&number=" . $row['phoneNo']; ?>"
                                                                class="btn btn-dark"><i
                                                                    class="fas fa-envelope"></i>&nbsp; Send
                                                                Message</a>
                                                        </div>
                                                    </td>
                                                </tr>
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
                                            </tbody>
                                        </table>
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
    <?php include('inc/script.php'); ?>
    <!-- Page Specific JS File -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>

    <?php require('../message.php'); ?>
    <!-- Template JS File -->
</body>


</html>