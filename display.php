<tr>
    <th>Image</th>
    <th>Roll No</th>
    <th>Name</th>
    <th>Class</th>
    <th>Date</th>
    <th>Time</th>
    <th>Status</th>
</tr>
<?php
include('dbconfig.php');
include('function.php');
date_default_timezone_set('Asia/Karachi');
$runningdate = date('Y-m-d');
// echo "<script>alert('" . $runningdate . "');</script>";
$sql = "SELECT *,DATE_FORMAT(`attedance_date`, '" . "%M %d %Y" . "') as indate,TIME_FORMAT(`attedance_date`, '" . "%T" . "') as intime FROM daily_attendance as da,student_detail as sa WHERE da.reg_id = sa.reg_id and da.attendace_status=1 and DATE_FORMAT(`attedance_date`,'%Y-%m-%d') LIKE '$runningdate' order by intime DESC limit 7";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<tr>
    <td>
        <img alt="image" src="admin/insert/<?php echo $row['std_image']; ?>" class="rounded-circle" width="40"
            data-toggle="tooltip" title="Wildan Ahdian">
    </td>
    <td><?php echo $row['reg_id']; ?></td>
    <td><?php echo $row['std_name']; ?></td>
    <td><?php echo getclassnamebyid($row['class']); ?></td>
    <td><?php echo $row['indate']; ?></td>
    <td><?php echo $row['intime']; ?></td>

    <td>
        <div class="badge badge-success"><?php echo $row['attendace_status'] == 1 ? 'Present' : ''; ?></div>
    </td>
</tr>
<?php
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>