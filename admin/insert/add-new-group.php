<?php
if (isset($_POST['submit'])) {
    include_once '../../dbconfig.php';
    try {
        // Create prepared statement
        $sql = "INSERT INTO `stdgroup`(`gid`, `g_name`) VALUES (null,:g_name)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters to statement
        $stmt->bindParam(':g_name', $_REQUEST['groupName']);

        // Execute the prepared statement
        $stmt->execute();

        session_start();
        $message = array(
            'content' => 'Record Saved successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["sweetmsg"] = json_encode($message);
        header("Location: ../view-group.php");
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    // Close connection
    unset($pdo);
} else {
    header("Location: ../index.php");
    die();
}