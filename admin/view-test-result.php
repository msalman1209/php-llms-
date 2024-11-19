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
                        <!-- add content here -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>View Result</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Roll No</th>
                                                        <th>Test Title</th>
                                                        <th>Test Date</th>
                                                        <th>Subject</th>
                                                        <th>Obtain Marks</th>
                                                        <th>Total Marks</th>
                                                        <th>Percentage</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    try {
                                                        include('../dbconfig.php');
                                                        $sql = "SELECT *,DATE_FORMAT(`result_date`, '" . "%M %d %Y" . "') as resultdate FROM `test_result` ORDER BY `result_date` DESC";
                                                        $result = $pdo->query($sql);
                                                        $counter = 0;
                                                        if ($result->rowCount() > 0) {
                                                            while ($row = $result->fetch()) { ?>
                                                    <tr class="text-center">
                                                        <td><?php echo $counter += 1; ?></td>
                                                        <td><?php echo $row['reg_id']; ?></td>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['resultdate']; ?></td>
                                                        <td><?php echo $row['subjectName']; ?></td>
                                                        <td><?php echo $row['subjectMarks']; ?></td>
                                                        <td><?php echo $row['subjectTotal']; ?></td>
                                                        <td><?php echo bcdiv((($row['subjectMarks']) / ($row['subjectTotal'])) * 100, 1, 2) . "%"; ?>
                                                        </td>
                                                        <td><?php echo $row['msgstatus'] == 0 ? 'Message Not Send' : 'Message Send';  ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-dark"
                                                                href="message/result-test-message.php?id=<?php echo $row['reg_id'] . "&date=" . $row['result_date']; ?>"><i
                                                                    class="fa fa-envelope"></i></a>
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
                    </div>
                </section>

            </div>
            <?php include('../admin/inc/footer.php'); ?>
        </div>
    </div>
    <?php include('inc/script.php'); ?>
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>

    <?php require('../message.php'); ?>


</body>


</html>