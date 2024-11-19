<?php
function getclassnamebyid($id)
{
    try {
        include('dbconfig.php');
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