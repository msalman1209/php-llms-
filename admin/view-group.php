<?php
include('auth.php');
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form action="insert/add-new-group.php" method="POST">
                                        <div class="card-header">
                                            <h4>Add New Group</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="groupName"
                                                    placeholder="Enter Group Name Here" required="">
                                            </div>
                                        </div>
                                        <div class="card-footer text-left">
                                            <input class="btn btn-primary" id="btn-submit" type="submit" value="Save"
                                                name="submit">
                                            <a id="btn-progress"
                                                class="btn btn-primary btn-progress disabled">progress</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- add content here -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Group Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Group ID</th>
                                                        <th>Class</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    try {
                                                        include('../dbconfig.php');
                                                        $sql = "SELECT * FROM stdgroup";
                                                        $result = $pdo->query($sql);
                                                        $counter = 0;
                                                        if ($result->rowCount() > 0) {
                                                            while ($row = $result->fetch()) { ?>
                                                    <tr>
                                                        <td><?php echo $counter += 1; ?></td>
                                                        <td><?php echo $row['gid']; ?></td>
                                                        <td><?php echo $row['g_name']; ?></td>
                                                        <td><a class="btn btn-danger"
                                                                href="delete/delete-group.php?id=<?php echo $row['gid']; ?>"><i
                                                                    class="fa fa-trash"></i></a></td>

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
    <!-- Page Specific JS File -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <script>
    $(document).ready(function() {
        $("#btn-progress").hide();
        $("form").submit(function() {
            $("#btn-submit").hide();
            $("#btn-progress").show();
        });
    });
    </script>
    <?php require('../message.php'); ?>
    <!-- Template JS File -->
</body>


</html>