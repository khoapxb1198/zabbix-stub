<?php

$url = "https://ubnt.cloud.tpsc.vn/api/s/trsh39nr/stat/alarm";

// Headers with correct cookie format
$headers = [
    "Cookie: unifises=gZVlG2wdCuWvu1qUNJ9N3vrVt8GLnyG4; csrf_token=FKZR5Vp0YnSUZlx9Y2Z6EohJrtvqHfOW"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Enable for self-signed certs
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    die("cURL error: " . curl_error($ch));
}

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code !== 200) {
    die("Request failed with HTTP code: $http_code");
}

// Decode the JSON
$data = json_decode($response, true);

// Extract alarms from the 'data' key
$alarms = $data['data'] ?? [];

if (is_array($alarms)) {
    $limit = min(20, count($alarms));

    for ($i = 0; $i < $limit; $i++) {
        if (isset($alarms[$i]['msg']) && isset($alarms[$i]['datetime'])) {
            echo "Message: " . htmlspecialchars($alarms[$i]['msg']) . "<br>";
            echo "Datetime: " . htmlspecialchars($alarms[$i]['datetime']) . "<br><br>";
        }
    }
} else {
    echo "No valid data found.";
}
