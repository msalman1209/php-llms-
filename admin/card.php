<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon l-bg-purple">
                <i class="fas fa-book-reader"></i>
            </div>
            <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                        <h3 class="font-light mb-0">
                            <i class="ti-arrow-up text-success"></i>
                            <?php
                            include_once '../dbconfig.php';
                            $result = mysqli_query($conn, "SELECT count(*) as count_std FROM `student_detail`");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo $row['count_std'];
                                }
                            } else {
                                echo "0";
                            }
                            ?>
                        </h3>
                        <span class="text-muted">Total Students</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon l-bg-green">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                        <h3 class="font-light mb-0">
                            <i class="ti-arrow-up text-success"></i>
                            <?php
                            include_once '../dbconfig.php';
                            $result = mysqli_query($conn, "SELECT count(*) as count_teacher FROM `teacher_detail`");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo $row['count_teacher'];
                                }
                            } else {
                                echo "0";
                            }
                            ?>
                        </h3>
                        <span class="text-muted">Total Teachers</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon l-bg-cyan">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                        <h3 class="font-light mb-0">
                            <i class="ti-arrow-up text-success"></i>
                            <?php
                            include_once '../dbconfig.php';
                            date_default_timezone_set('Asia/Karachi');
                            $runningdate = date('Y-m-d');
                            $result = mysqli_query($conn, "SELECT count(*) as count_present FROM daily_attendance as da WHERE da.attendace_status=1 and DATE_FORMAT(`attedance_date`,'%Y-%m-%d') LIKE '$runningdate'");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo $row['count_present'];
                                }
                            } else {
                                echo "0";
                            }
                            ?>
                        </h3>
                        <span class="text-muted">Total Students Present</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon l-bg-orange">
                <i class="far fa-list-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                        <h3 class="font-light mb-0">
                            <i class="ti-arrow-up text-success"></i>
                            <?php
                            include_once '../dbconfig.php';
                            $result = mysqli_query($conn, "SELECT count(*) as count_absent FROM daily_attendance as da WHERE da.attendace_status=0 and DATE_FORMAT(`attedance_date`,'%Y-%m-%d') LIKE '$runningdate'");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo $row['count_absent'];
                                }
                            } else {
                                echo "0";
                            }
                            ?>
                        </h3>
                        <span class="text-muted">Total Students Absent</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>