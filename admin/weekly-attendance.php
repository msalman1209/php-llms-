<?php
include('auth.php');
date_default_timezone_set('Asia/Karachi');
$from_date = date('Y-m-d', strtotime("-7 days"));
$to_date = date('Y-m-d');
if (isset($_POST['search'])) {
    $from_date = $_POST['fromDated'];
    $to_date = $_POST['toDated'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TSF | Attendace Report</title>
    <!-- General CSS Files -->
    <?php include('inc/link.php'); ?>
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
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-2 mr-sm-2">
                                                <label>From:</label>
                                                <input type="date" name="fromDated" class="form-control"
                                                    value="<?php echo $from_date; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-2 mr-sm-2">
                                                <label>To:</label>
                                                <input type="date" name="toDated" class="form-control"
                                                    value="<?php echo $to_date; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button">
                                        <button type="submit" name="search"
                                            class="btn btn-icon icon-left btn-lg btn-primary"><i
                                                class="fas fa-search"></i>Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Weekly Attendance Report</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport"
                                                style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Roll No</th>
                                                        <th>Absents</th>
                                                        <th>Presents</th>
                                                        <th>Leaves</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    try {
                                                        include('../dbconfig.php');
                                                        $sql = "SELECT `reg_id`, count(case when `attendace_status` = 0 then 1 end) as absent_count, count(case when attendace_status =1 then 1 end) as present_count, count(case when attendace_status = 3 then 1 end) as leave_count FROM `daily_attendance` 
                                                        WHERE `attedance_date` BETWEEN '$from_date 00:00:59.000000' AND '$to_date 23:59:59.000000' GROUP BY reg_id ORDER BY `reg_id` ASC;";
                                                        $result = $pdo->query($sql);
                                                        $counter = 0;
                                                        if ($result->rowCount() > 0) {
                                                            while ($row = $result->fetch()) { ?>
                                                    <tr>
                                                        <td><?php echo $row['reg_id']; ?></td>
                                                        <td><?php echo $row['absent_count']; ?></td>
                                                        <td><?php echo $row['present_count']; ?></td>
                                                        <td><?php echo $row['leave_count']; ?></td>
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
                    </div>
                </section>
                <?php include('../admin/inc/setting.php'); ?>

            </div>
            <?php include('../admin/inc/footer.php'); ?>
        </div>
    </div>
    <?php include('inc/script.php'); ?>
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>

</body>


</html>