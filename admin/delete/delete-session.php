<?php
if (isset($_GET["id"])) {
    include_once '../../dbconfig.php';
    try {
        // sql to delete a record
        $sql = "DELETE FROM `stdsession` WHERE `sid`=" . $_GET["id"];

        // use exec() because no results are returned
        $pdo->exec($sql);
        session_start();
        $message = array(
            'content' => 'Record Deleted successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        header("Location: ../view-session.php");
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    unset($pdo);
} else {
    header("Location: index.php");
}