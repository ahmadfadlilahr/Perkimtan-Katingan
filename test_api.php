<?php

// Simple API test script
$baseUrl = 'http://dinas-perkim.test';

// Test public berita endpoint
echo "=== Testing Public Berita API ===\n";
$url = $baseUrl . '/api/public/berita?limit=2';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $httpCode\n";
echo "Response:\n";

if ($response) {
    $data = json_decode($response, true);
    if ($data) {
        echo "Success: " . ($data['success'] ? 'true' : 'false') . "\n";
        echo "Message: " . ($data['message'] ?? 'N/A') . "\n";

        if (isset($data['data']) && is_array($data['data'])) {
            echo "Total Records: " . count($data['data']) . "\n";

            // Check first record structure
            if (count($data['data']) > 0) {
                $firstRecord = $data['data'][0];
                echo "First Record Fields: " . implode(', ', array_keys($firstRecord)) . "\n";

                // Check if penulis field exists and has value
                if (isset($firstRecord['penulis'])) {
                    echo "Author Field (penulis): '" . $firstRecord['penulis'] . "'\n";
                } else {
                    echo "WARNING: Author field (penulis) not found!\n";
                }
            }
        } else {
            echo "No data array found in response\n";
        }
    } else {
        echo "Failed to decode JSON response\n";
        echo $response . "\n";
    }
} else {
    echo "Failed to get response\n";
}

echo "\n=== End Test ===\n";
