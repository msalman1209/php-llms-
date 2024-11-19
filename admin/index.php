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
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon1.png' />
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
                        <?php include('../admin/card.php'); ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Chart</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart4" class="chartsh"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Chart</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="summary">
                                            <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                                                <div id="chart3" class="chartsh"></div>
                                            </div>
                                            <div data-tab-group="summary-tab" id="summary-text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Chart</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart2" class="chartsh"></div>
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
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/page/index.js"></script>


</body>
<?php require('../message.php'); ?>


</html>