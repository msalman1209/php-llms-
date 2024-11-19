<?php
if (isset($_POST['rollno'])) {
    $rollno = $_POST['rollno'];
    include '../../dbconfig.php';
    $sql = "SELECT * FROM `student_detail` as std, class as cls, stdgroup as grp WHERE  std.`class` = cls.cid and std.`std_group`= grp.gid and std.reg_id='" . $rollno . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo json_encode(array("name" => $row['std_name'], "class" => $row['class_name'], "group" => $row['g_name'], "subjects" => $row['subjects']));
        }
    } else {
        echo "<script>
alert('No Data Find.');
</script>";
    }
    mysqli_close($conn);
}