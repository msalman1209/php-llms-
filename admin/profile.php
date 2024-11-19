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
                        <div class="row mt-sm-4">
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card author-box">
                                    <div class="card-body">
                                        <div class="author-box-center">
                                            <img alt="image" src="assets/img/2.png"
                                                class="rounded-circle author-box-picture">
                                            <div class="clearfix"></div>
                                            <div class="author-box-name">
                                                <a href="#"><?php echo $_SESSION['username']; ?></a>
                                            </div>
                                            <div class="author-box-job">TSF Academy Of Science And Arts</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="author-box-description">
                                                <p>
                                                    +92 306 2736167<br>
                                                    Chandni Chowk 428-C Ghulam Muhammad Abad Faisalabad.
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Support</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="py-4">
                                            <p class="clearfix">
                                                <span class="float-left">
                                                    Website
                                                </span>
                                                <span class="float-right text-muted">
                                                    www.techterms.com.pk
                                                </span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">
                                                    Phone
                                                </span>
                                                <span class="float-right text-muted">
                                                    +92 304 4877950
                                                </span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">
                                                    Mail
                                                </span>
                                                <span class="float-right text-muted">
                                                    mubashirali8561@gmail.com
                                                </span>
                                            </p>
                                            <!-- <p class="clearfix">
                                                <span class="float-left">
                                                    Facebook
                                                </span>
                                                <span class="float-right text-muted">
                                                    <a href="#"></a>
                                                </span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">
                                                    Twitter
                                                </span>
                                                <span class="float-right text-muted">
                                                    <a href="#"></a>
                                                </span>
                                            </p> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="card">
                                    <div class="padding-20">

                                        <div class="tab-content tab-bordered" id="myTab3Content">

                                            <div class="tab-pane fade show active" id="settings" role="tabpanel"
                                                aria-labelledby="profile-tab2">
                                                <form method="post" class="needs-validation">
                                                    <div class="card-header">
                                                        <h4>Edit Profile</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-6 col-12">
                                                                <label>Upload Image</label>
                                                                <input type="file" class="form-control" value="Deo">
                                                                <div class="invalid-feedback">
                                                                    Please fill in the upload Image
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <button class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
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

</body>


</html>