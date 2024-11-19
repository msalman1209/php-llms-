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
                                    <form action="view-class-result.php" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <div class="form-line">
                                                    <label for="inputPassword4">Class:</label>

                                                    <select class="custom-select" id="classwise" name="class">
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
                                            <div class="form-group col-md-6">
                                                <label for="result_date">Date:</label>
                                                <input type="date" class="form-control" id="result_date"
                                                    name="result_date" value="2023-01-16">
                                            </div>
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Result Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="tableExport"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Roll No</th>
                                                    <th>Name</th>
                                                    <th>Father</th>
                                                    <th>Date</th>
                                                    <th>Subject</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_POST['class']) && isset($_POST['result_date']) && !empty($_POST['class']) && !empty($_POST['result_date'])) {
                                                    $id = $_POST['class'];
                                                    $date = $_POST['result_date'];
                                                    include '../dbconfig.php';
                                                    $sql = "SELECT * from student_detail WHERE class=$id ORDER BY id";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<tr><td>';
                                                            echo $row['reg_id'];
                                                            echo '</td><td>';
                                                            echo $row['std_name'];
                                                            echo '</td><td>';
                                                            echo $row['std_fathername'];
                                                            echo '</td><td>';
                                                            echo $date;
                                                            echo '</td><td><table><tbody>';
                                                            $sqlone = "SELECT subjectName,subjectMarks,subjectTotal from result as res WHERE res.reg_id ='" . $row['reg_id'] . "' and res.result_date LIKE '%$date%'";
                                                            $resultone = $conn->query($sqlone);
                                                            if ($resultone->num_rows > 0) {
                                                                while ($rowone = $resultone->fetch_assoc()) {
                                                                    echo '';
                                                                    echo $rowone['subjectName'];
                                                                    echo '-';
                                                                    echo $rowone['subjectMarks'];
                                                                    echo ',';
                                                                }
                                                            }
                                                            echo '</tbody></table></td></tr>';
                                                        }
                                                    } else {
                                                        echo "No Data Find.";
                                                    }
                                                    mysqli_close($conn);
                                                }
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
</body>

</html>