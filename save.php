<?php
include('dbconfig.php');
$name = $_POST['name'];
date_default_timezone_set('Asia/Karachi');
$runningdate = date('Y-m-d h:i:s');
$currentdate = date('Y-m-d');

$duplicate = mysqli_query($conn, "SELECT * FROM `daily_attendance` WHERE `attedance_date` LIKE '$currentdate%' AND `reg_id` = '$name' AND `attendace_status` = 1");
if (mysqli_num_rows($duplicate) > 0) {
    echo json_encode(array("statusCode" => 100));
} else {
    $sql = "INSERT INTO `daily_attendance`( `attedance_date`, `reg_id`, `attendace_status`) VALUES ('$runningdate','$name',1)";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}
mysqli_close($conn);