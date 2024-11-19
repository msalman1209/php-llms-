<?php
date_default_timezone_set('Asia/Karachi');
$runningdate = date('Y-m-d h:i:s');
if (isset($_POST['submit'])) {
    include_once '../../dbconfig.php';
    try {
        // Create prepared statement
        $sql = "INSERT INTO `messages`(`messagetitle`, `messageurl`, `messagedesc`, `created_date`) VALUES (:messagetitle,:messageurl,:messagedesc,:created_date)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters to statement
        $stmt->bindParam(':messagetitle', $_REQUEST['title']);
        $stmt->bindParam(':messageurl', $_REQUEST['url']);
        $stmt->bindParam(':messagedesc', $_REQUEST['messagedesc']);
        $stmt->bindParam(':created_date', $runningdate);

        // Execute the prepared statement
        $stmt->execute();

        session_start();
        $message = array(
            'content' => 'New Message Created successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["sweetmsg"] = json_encode($message);
        header("Location: ../create-message.php");
    } catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    // Close connection
    unset($pdo);
} else {
    header("Location: ../index.php");
    die();
}