<?php
include('auth.php');
if (isset($_GET['id']) && isset($_GET['date'])) {
    $rollno = $_GET["id"];
    $runningdate = $_GET["date"];
    $date = date_create($runningdate);
}
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
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Student Details</h4>
                            </div>
                            <div id="div1"></div>
                            <div class="card-body">
                                <div class="section-title mt-0">Information</div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">Roll No</label>
                                        <input type="text" id="rollno" class="form-control"
                                            value="<?php echo $rollno; ?>" disabled />
                                    </div>
                                    <div class="col-3">
                                        <label for="">Date</label>
                                        <input type="date" id="ResultDate"
                                            value="<?php echo date_format($date, "Y-m-d"); ?>" class="form-control"
                                            disabled />
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="stdname" disabled />
                                    </div>
                                    <div class="col-3">
                                        <label for="">Class</label>
                                        <input type="text" class="form-control" id="stdclass" disabled />
                                    </div>
                                    <div class="col-3">
                                        <label for="">Group</label>
                                        <input type="text" class="form-control" id="stdgroup" disabled />
                                    </div>
                                </div><br>
                                <div class="button">
                                    <button id="FindData" class="btn btn-primary">Find Date</button>
                                    <button id="ProgressBtn"
                                        class="btn disabled btn-primary btn-progress">Progress</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Result Card</h4>
                            </div>
                            <div class="card-body">
                                <table id="table_id" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Subject Name</th>
                                            <th scope="col">Obtain Marks</th>
                                            <th scope="col">Total Marks</th>
                                            <!-- <th scope="col">Grade</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            include('../dbconfig.php');
                                            $sql = "SELECT * FROM `result` WHERE `reg_id`='$rollno' and `result_date`='$runningdate'";
                                            $result = $pdo->query($sql);
                                            $counter = 0;
                                            if ($result->rowCount() > 0) {
                                                while ($row = $result->fetch()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row["subjectName"]; ?></td>
                                            <td><?php echo $row["subjectMarks"]; ?></td>
                                            <td><?php echo $row["subjectTotal"]; ?></td>
                                            <!-- <td><?php //echo $row["subjectGrade"]; 
                                                                    ?></td> -->
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
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="button text-center">
                            <button id="updateResult" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp;Update
                                Record</button>
                            <button id="deleteResult" class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp;Delete
                                Record</button>
                            <a href="message/result-message.php?id=<?php echo $rollno . "&date=" . $runningdate; ?>"
                                class="btn btn-dark"><i class="fas fa-envelope"></i>&nbsp;Send
                                Message</a>
                        </div>
                        <div class="button text-center p-2">
                            <form method="post"
                                action="pdf/generate_pdf.php?id=<?php echo $rollno . "&date=" . $runningdate; ?>">
                                <button type="submit" id="pdf" name="generate_pdf" class="btn btn-info"><i
                                        class="fas fa-file-pdf"" aria-hidden=" true"></i>
                                    Generate PDF</button>
                            </form>
                        </div>
                    </div>
                </section>
                <?php include('../admin/inc/setting.php'); ?>
            </div>
            <?php include('../admin/inc/footer.php'); ?>
        </div>
    </div>
    <?php include('inc/script.php'); ?>
    <script>
    $(document).ready(function() {
        // $("#ProgressBtn").show();
        // $("#FindData").show();
        $('#FindData').on('click', function() {
            var rollno = $('#rollno').val();
            if (rollno != "") {
                $.ajax({
                    url: "result/find-data.php",
                    type: "POST",
                    data: {
                        rollno: rollno,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        var data = dataResult.subjects;
                        $("#stdname").val(dataResult.name);
                        $("#stdclass").val(dataResult.class);
                        $("#stdgroup").val(dataResult.group);
                        $("#ProgressBtn").hide();
                    }
                });
            } else {
                alert('Enter Roll No Please.');
                $("#ProgressBtn").hide();
                $("#FindData").show();
                $("#rollno").focus();
            }
        });
    });
    </script>
    <script>
    jQuery(function() {
        jQuery('#FindData').click();
        $("#FindData").hide();
    });
    </script>


</body>


</html>