<?php
include('auth.php');
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
                                <div class="card-header">
                                    <h4>Teacher Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="tableExport"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Father Name</th>
                                                    <th>DOB</th>
                                                    <th>Phone No</th>
                                                    <th>Cell No</th>
                                                    <th>Email</th>
                                                    <th>Present Add.</th>
                                                    <th>CNIC</th>
                                                    <th>Joining Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                try {
                                                    include('../dbconfig.php');
                                                    $sql = "SELECT * FROM teacher_detail";
                                                    $result = $pdo->query($sql);
                                                    $counter = 0;
                                                    if ($result->rowCount() > 0) {
                                                        while ($row = $result->fetch()) { ?>
                                                <tr>
                                                    <td><?php echo $counter += 1; ?></td>
                                                    <td>
                                                        <img alt="Image"
                                                            src="../admin/insert/<?php echo $row['t_image']; ?>"
                                                            width="35">
                                                    </td>
                                                    <td>
                                                        <?php echo $row['t_name']; ?>
                                                    </td>
                                                    <td><?php echo $row['fatherName']; ?></td>
                                                    <td><?php echo $row['DOB']; ?></td>
                                                    <td><?php echo $row['phoneNo']; ?></td>
                                                    <td><?php echo $row['cellNo']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['Address']; ?></td>
                                                    <td><?php echo $row['CNIC']; ?></td>
                                                    <td><?php
                                                                    $dt = new DateTime($row['created_at']);
                                                                    echo $dt->format('Y-M-d'); ?></td>
                                                    <td>
                                                        <a class="btn btn-warning"
                                                            href="update-teacher.php?id=<?php echo $row['tid']; ?>"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <a class="btn btn-danger"
                                                            href="delete/delete-teacher.php?id=<?php echo $row['tid']; ?>"><i
                                                                class="fas fa-trash-alt"></i></a>
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