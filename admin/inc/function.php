<?php
function getclassnamebyid($id)
{
    try {
        include('../dbconfig.php');
        $sql = "SELECT * FROM `class` WHERE `cid`=" . $id;
        $result = $pdo->query($sql);
        $counter = 0;
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                echo  $row["class_name"];
            }
        } else {
            echo "No Class";
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    // Close connection
    unset($pdo);
}
function getgroupnamebyid($id)
{
    try {
        include('../dbconfig.php');
        $sql = "SELECT * FROM `stdgroup` WHERE `gid`=" . $id;
        $result = $pdo->query($sql);
        $counter = 0;
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                echo  $row["g_name"];
            }
        } else {
            echo "No Group";
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    // Close connection
    unset($pdo);
}
function getsessionnamebyid($id)
{
    try {
        include('../dbconfig.php');
        $sql = "SELECT * FROM `stdsession` WHERE `sid`=" . $id;
        $result = $pdo->query($sql);
        $counter = 0;
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                echo  $row["session_name"];
            }
        } else {
            echo "No Session";
        }
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    // Close connection
    unset($pdo);
}