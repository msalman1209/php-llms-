<?php
if (isset($_GET["id"])) {
    include_once '../../dbconfig.php';
    try {
        // sql to delete a record
        $sql = "DELETE FROM `messages` WHERE `message_id`=" . $_GET["id"];

        // use exec() because no results are returned
        $pdo->exec($sql);
        session_start();
        $message = array(
            'content' => 'Message Deleted successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        header("Location: ../create-message.php");
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    unset($pdo);
} else {
    header("Location: index.php");
}