<?php
include('auth.php');
date_default_timezone_set('Asia/Karachi');
$runningdate = date('Y-m-d');
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
                                        <input type="text" id="rollno" class="form-control" />
                                    </div>
                                    <div class="col-4">
                                        <label>Title</label>
                                        <select class="custom-select" id="title">
                                            <option selected="">Select Test Title</option>
                                            <option value="Test-1">Test-1</option>
                                            <option value="Test-2">Test-2</option>
                                            <option value="Test-3">Test-3</option>
                                            <option value="Test-4">Test-4</option>
                                            <option value="Test-5">Test-5</option>
                                            <option value="Test-6">Test-6</option>
                                            <option value="Test-7">Test-7</option>
                                            <option value="Test-8">Test-8</option>
                                            <option value="Test-9">Test-9</option>
                                            <option value="Test-10">Test-10</option>
                                            <option value="Test-11">Test-11</option>
                                            <option value="Test-12">Test-12</option>
                                            <option value="Test-13">Test-13</option>
                                            <option value="Test-14">Test-14</option>
                                            <option value="Test-15">Test-15</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Date</label>
                                        <input type="date" id="ResultDate" value="<?php echo $runningdate; ?>"
                                            class="form-control" />
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
                                    <button id="redo" class="btn btn-info"><i class="fas fa-redo-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Result Card</h4>
                            </div>
                            <div class="card-header">
                                <div class="button">
                                    <button id="addRowBtn" class="btn btn-primary">+ Add Row</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="table_id" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Subject Name</th>
                                            <th scope="col">Obtain Marks</th>
                                            <th scope="col">Total Marks</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="button text-center">
                            <button id="saveResult" class="btn btn-lg btn-success">Save
                                Result</button>
                            <button id="ProgressResult" class="btn disabled btn-success btn-progress">Progress</button>
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
        $("#rollno").focus();
        $("#ProgressBtn").hide();
        $("#ProgressResult").hide();
        $('#FindData').on('click', function() {
            $("#ProgressBtn").show();
            $("#FindData").hide();
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
        $('#redo').on('click', function() {
            $("#rollno").val('');
            $("#stdname").val('');
            $("#stdclass").val('');
            $("#stdgroup").val('');
            $("#FindData").show();
            $('#table_id tbody').empty();
            $("#rollno").focus();
        });
        $('#addRowBtn').on('click', function() {
            $('#table_id tbody').append("<tr><td><input type=" + "text" + " name=" + "subject" +
                " class=" + "form-control" + " /></td><td>" + "<input type=" + "number" +
                " min=" + "0" + " class=" + "form-control" + " name=" +
                "obtaininsub" + "" + " /></td><td>" +
                "<input type=" + "number" +
                " min=" + "0" + " class=" + "form-control" + " name=" +
                "totalinsub" + "" + " /></td><td><button id=" + "remove" + " class=" +
                "'btn btn-danger'" +
                ">-</butt></td></tr>"
            );
        });
        $('#table_id tbody').on('click', '#remove', function() {
            $(this).parent().parent().remove();
        });


        $("#saveResult").click(function() {
            $("#ProgressResult").show();
            $("#saveResult").hide();
            var rollno = $("#rollno").val();
            var title = $("#title").val();
            var ResultDate = $("#ResultDate").val();
            let result = [];
            $("table tbody tr").each(function() {
                var allValues = {};
                $(this).find("input").each(function(index) {
                    const fieldName = $(this).attr("name");
                    allValues[fieldName] = $(this).val();
                });
                // console.log(allValues);
                result.push(allValues);
            })

            $.ajax({
                url: "result/save-test-result.php",
                type: "POST",
                data: {
                    rollno: rollno,
                    title: title,
                    ResultDate: ResultDate,
                    result: result
                },
                cache: false,
                success: function(Rdata) {
                    // alert(Rdata);
                    var Rdata = JSON.parse(Rdata);
                    console.log(Rdata.result);
                    switch (Rdata.statusCode) {
                        case 200:
                            // swal('Good Job!', 'Result Uploaded Succssfully', 'success');
                            iziToast.success({
                                title: 'Good Job!',
                                message: 'Result Uploaded Succssfully',
                                position: 'topRight'
                            });
                            $("#ProgressResult").hide();
                            $("#saveResult").show();
                            $("#redo").click();
                            break;
                        case 201:
                            alert("Error occured !");
                            break;
                    }
                }
            });
        });
    });
    </script>
</body>


</html>