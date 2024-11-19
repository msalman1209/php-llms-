<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TSF Massage Report</title>
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon1.png' />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <?php
    // API URL
    $api_url = 'https://panel.rapiwha.com/get_messages.php?apikey=TXG008WPVUYS6ABBL94I';

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Fetch data from API
    $data = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        echo "Failed to fetch data from the API: " . curl_error($curl);
    } else {
        // Check if data was fetched successfully
        if (!$data) {
            echo "Failed to fetch data from the API.";
        } else {
            // Data fetched successfully, you can process it as needed
            // For example, you can decode JSON data if it's returned as JSON
            $decoded_data = json_decode($data, true);

            // Check if JSON decoding was successful
            if ($decoded_data === NULL) {
                echo "Failed to decode JSON data.";
            } else {
                // Output the data in a table
                if (!empty($decoded_data)) {
                    echo "<table>";
                    echo "<tr><th>To</th><th>Sender</th><th>Message</th><th>Timestamp</th><th>Process Date</th><th>Failed Date</th></tr>";
                    foreach ($decoded_data as $message) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars(isset($message['to']) ? $message['to'] : 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars(isset($message['from']) ? $message['from'] : 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars(isset($message['text']) ? $message['text'] : 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars(isset($message['creation_date']) ? $message['creation_date'] : 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars(isset($message['process_date']) ? $message['process_date'] : 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars(isset($message['failed_date']) ? $message['failed_date'] : 'N/A') . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No data available.";
                }
            }
        }
    }

    // Close cURL session
    curl_close($curl);
    ?>

</body>

</html>