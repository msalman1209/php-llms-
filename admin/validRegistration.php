<?php
include('../dbconfig.php');
$name = $_POST['name'];

$duplicate = mysqli_query($conn, "SELECT * FROM `student_detail` WHERE `reg_id`='$name'");
if (mysqli_num_rows($duplicate) > 0) {
    echo json_encode(array("statusCode" => 201));
}else{
    echo json_encode(array("statusCode" => 200));
}
mysqli_close($conn);