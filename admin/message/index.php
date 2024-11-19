<?php
session_start();
$token = $_SESSION["token"];
if (isset($_GET['msg']) && isset($_GET['number'])) {
    $message = $_GET['msg'];
    $number = $_GET['number'];
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://demo.stackposts.com/wamo/api/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'number' => $number,
            'type' => 'text',
            'message' => $message,
            'instance_id' => '65423821F31ED',
            'access_token' => '6444f5e86558f'
        ]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        session_start();
        $message = array(
            'content' => 'Message Not Send.',
            'type' => 'error',
            'cssClass' => 'error'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        echo "cURL Error #:" . $err;
    } else {
        // echo $response;
        session_start();
        $message = array(
            'content' => 'Message Send successfully.',
            'type' => 'success',
            'cssClass' => 'success'
        );
        $_SESSION["toastmsg"] = json_encode($message);
        header("Location: ../daily-attendance.php");
    }
}
