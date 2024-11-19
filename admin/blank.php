<?php
include('auth.php');
?>
<!DOCTYPE html>
<html lang="en">


<head>
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
                    </div>
                </section>
                <?php include('../admin/inc/setting.php'); ?>

            </div>
            <?php include('../admin/inc/footer.php'); ?>
        </div>
    </div>
    <?php include('inc/script.php'); ?>

</body>


</html>