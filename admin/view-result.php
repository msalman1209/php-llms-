<?php
include('auth.php');
include('Grade.php');
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
                                                        <th>Result Date</th>
                                                        <th>Obtain Marks</th>
                                                        <th>Total Marks</th>
                                                        <th>Percentage</th>
                                                        <th>Grade</th>
                                                        <th>Status</th>
                                                        <th>PDF</th>
                                                        <th>View</th>
                                                        <th>Massage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    try {
                                                        include('../dbconfig.php');
                                                        $sql = "SELECT *,DATE_FORMAT(`result_date`, '" . "%M %d %Y" . "') as resultdate,SUM(`subjectMarks`) as obtain, SUM(`subjectTotal`)as total FROM `result` GROUP BY `reg_id`,`result_date` ORDER BY `result_date` DESC";
                                                        $result = $pdo->query($sql);
                                                        $counter = 0;
                                                        if ($result->rowCount() > 0) {
                                                            while ($row = $result->fetch()) { ?>
                                                    <tr class="text-center">
                                                        <td><?php echo $counter += 1; ?></td>
                                                        <td><?php echo $row['reg_id']; ?></td>
                                                        <td><?php echo $row['resultdate']; ?></td>
                                                        <td><?php echo $row['obtain']; ?></td>
                                                        <td><?php echo $row['total']; ?></td>
                                                        <td><?php echo bcdiv((($row['obtain']) / ($row['total'])) * 100, 1, 2) . "%"; ?>
                                                        </td>
                                                        <td><?php echo Gradecheck((($row['obtain']) / ($row['total'])) * 100); ?>
                                                        </td>
                                                        <td><?php echo $row['msgstatus'] == 0 ? 'Message Not Send' : 'Message Send'; ?>
                                                        </td>
                                                        <td>
                                                            <form method="post"
                                                                action="pdf/generate_pdf.php?id=<?php echo $row['reg_id'] . "&date=" . $row['result_date']; ?>">
                                                                <button type="submit" id="pdf" name="generate_pdf"
                                                                    class="btn btn-primary"><i
                                                                        class="fas fa-file-pdf"" aria-hidden="
                                                                        true"></i></button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-info"
                                                                href="view-single-result.php?id=<?php echo $row['reg_id'] . "&date=" . $row['result_date']; ?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-dark"
                                                                href="message/result-message.php?id=<?php echo $row['reg_id'] . "&date=" . $row['result_date']; ?>"><i
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
                <?php include('../admin/inc/setting.php'); ?>

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