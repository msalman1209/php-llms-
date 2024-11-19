<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TSF - Attendance</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/bundles/izitoast/css/iziToast.min.css">

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/logo1.png' />
    <style>
    .main-content {
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 10px;
        width: 100%;
        position: relative;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="jquery/jquery.min.js"></script> -->
    <script>
    function toastFunc() {
        iziToast.info({
            title: 'Dear Student!',
            message: 'Your Attendance Is Already Marked.',
            position: 'topRight'
        });
    }
    </script>
    <script>
    $(document).ready(function() {
        $('#rollno').on('change', function() {
            // $("#butsave").attr("disabled", "disabled");
            var name = $('#rollno').val();
            if (name != "") {
                $.ajax({
                    url: "save.php",
                    type: "POST",
                    data: {
                        name: name,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        switch (dataResult.statusCode) {
                            case 200:
                                location.reload();
                                break;
                            case 201:
                                alert("Error occured !");
                                break;
                            case 100:
                                $('#rollno').val('');
                                toastFunc();
                                break;
                        }
                        // if (dataResult.statusCode == 200) {
                        //     toastFunc();
                        //     location.reload();
                        // } else if (dataResult.statusCode == 201) {
                        //     alert("Error occured !");
                        // } else if (dataResult.statusCode == 100) {

                        //     $('#rollno').val('');
                        // }
                    }
                });
            } else {
                alert('Please fill all the field !');
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#rollno").focus();
        $.ajax({
            url: "display.php",
            type: "POST",
            cache: false,
            success: function(data) {
                $('#div1').html(data);
            }
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        setInterval(runningTime, 1000);
    });

    function runningTime() {
        $.ajax({
            url: 'timeScript.php',
            success: function(data) {
                $('#runningTime').html(data);
            },
        });
    }
    </script>

</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">

                        <div class="card">
                            <form id="fupForm" name="form1" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="rollno"
                                            placeholder="Scan Your Roll No" required="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Daily Attendance</h4>
                                        <div id="runningTime" style="margin-left: auto; margin-right: 0;"></div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="div1">

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/advance-table.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/toastr.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>

</body>

</html>