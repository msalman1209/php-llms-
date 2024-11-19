<?php
session_start();

if (isset($_GET['msg']) && isset($_GET['number'])) {
    $message = $_GET['msg'];
    $number = $_GET['number'];

    // Constructing the URL
    $url = "https://panel.rapiwha.com/send_message.php";
    $apikey = "TXG008WPVUYS6ABBL94I";
    $url .= "?apikey=" . urlencode($apikey);
    $url .= "&number=" . urlencode($number);
    $url .= "&text=" . urlencode($message);

    // Sending the request
    $response = file_get_contents($url);

    // Checking for errors
    if ($response === false) {
        $message = array(
            'content' => 'Message Not Sent.',
            'type' => 'error',
            'cssClass' => 'error'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        echo "Error: Unable to send message.";
    } else {
        $message = array(
            'content' => 'Message Sent successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        echo "<script>window.close();</script>";
    }
} else {
    echo "Error: Required parameters are missing.";
}
