<?php
if (isset($_GET['msg']) && isset($_GET['number'])) {
    $message = $_GET['msg'];
    $number = $_GET['number'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://panel.rapiwha.com/send_message.php?apikey=TXG008WPVUYS6ABBL94I&number=" . urlencode($number) . "&text=" . urlencode($message),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        session_start();
        $message = array(
            'content' => 'Message Not Sent.',
            'type' => 'error',
            'cssClass' => 'error'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        echo "cURL Error #:" . $err;
    } else {
        session_start();
        $message = array(
            'content' => 'Message Sent successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        if (isset($_GET['url'])) {
            $urlParam = $_GET['url'];
            if ($urlParam == 'test') {
                header("Location: ../view-test-result.php");
            } else if ($urlParam == 'result') {
                header("Location: ../view-result.php");
            } else {
                header("Location: ../index.php");
            }
        } else {
            header("Location: ../index.php");
        }
    }
}
