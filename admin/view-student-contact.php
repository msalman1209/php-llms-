<?php
include('auth.php');
include('inc/function.php');
if (isset($_POST['submit'])) {
    if (!isset($_POST['selectmessage'])) {
        session_start();
        $message = array(
            'content' => 'Select message you want to send. Message is not selected',
            'type' => 'error',
            'cssClass' => 'error'
        );
        $_SESSION["toastmsg"] = json_encode($message);
    } else if (!isset($_POST['phone'])) {
        session_start();
        $message = array(
            'content' => 'Please Select Phone No.',
            'type' => 'error',
            'cssClass' => 'error'
        );
        $_SESSION["toastmsg"] = json_encode($message);
    } else {
        $message = $_POST['selectmessage'];
        $number = $_POST['phone'];
        for ($i = 0; $i < sizeof($number); $i++) {
            echo "<script type=" . "text/javascript" . " language=" . "Javascript" . ">window.open('message/send.php?msg=" . $message . "&number=" . $number[$i] . "');</script>";
        }
    }
}
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form action="" method="POST">
                                        <div class="card-header">
                                            <h4>Send Message</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Select Your Message</label>
                                                <select id="selectmsg" name="selectmessage" class="form-control" multiple="" data-height="100%" style="height: 100%;">
                                                    <?php
                                                    try {
                                                        include('../dbconfig.php');
                                                        $sql = "SELECT * FROM `messages`";
                                                        $result = $pdo->query($sql);
                                                        $counter = 0;
                                                        if ($result->rowCount() > 0) {
                                                            while ($row = $result->fetch()) { ?>
                                                                <option value="<?php echo $row['messagedesc']; ?>">
                                                                    <?php echo $row['messagedesc']; ?>
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
                                            <div class="table-responsive">
                                                <table class="table" style="width:100%;">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" onclick="toggle(this);" />Check
                                                                all</th>
                                                            <th class="text-center">
                                                                #
                                                            </th>
                                                            <th>Image</th>
                                                            <th>Roll No</th>
                                                            <th>Name</th>
                                                            <th>Father Name</th>
                                                            <th>Class</th>
                                                            <th>Group</th>
                                                            <th>Phone No</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        try {
                                                            include('../dbconfig.php');
                                                            $sql = "SELECT * FROM student_detail";
                                                            $result = $pdo->query($sql);
                                                            $counter = 0;
                                                            if ($result->rowCount() > 0) {
                                                                while ($row = $result->fetch()) { ?>
                                                                    <tr>
                                                                        <td><input type="checkbox" name="phone[]" value="<?php echo $row['phoneNo']; ?>">
                                                                        </td>
                                                                        <td><?php echo $counter += 1; ?></td>
                                                                        <td>
                                                                            <img alt="Image" src="../admin/insert/<?php echo $row['std_image']; ?>" width="60px" height="60px">
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['reg_id']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['std_name']; ?>
                                                                        </td>
                                                                        <td><?php echo $row['std_fathername']; ?></td>
                                                                        <td><?php echo getclassnamebyid($row['class']); ?></td>
                                                                        <td><?php echo getgroupnamebyid($row['std_group']); ?></td>
                                                                        <td><?php echo $row['phoneNo']; ?></td>
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
                                        <div class="card-footer text-left">
                                            <input class="btn btn-dark" id="btn-submit" type="submit" value="Send Message" name="submit">
                                            <a id="btn-progress" class="btn btn-primary btn-progress disabled">progress</a>
                                        </div>
                                    </form>
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
    <script>
        $(document).ready(function() {
            $("#btn-progress").hide();
            $("form").submit(function() {
                $("#btn-submit").hide();
                $("#btn-progress").show();
            });
            $("#selectmsg").change(function() {
                if ($(this).val() == '') {
                    alert("Blank message Selected.");
                }
            });

        });

        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
    <?php require('../message.php'); ?>
    <!-- Template JS File -->
</body>


</html>