<?php

$url = "https://live.mpk.czest.pl/socket.io/?EIO=3&transport=polling&t=PAaQzsN";

// Inicjalizacja sesji cURL
$ch = curl_init($url);

// Ustawienie opcji, aby otrzymać odpowiedź jako string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ustawienie nagłówków, jeśli są wymagane (skopiuj je z DevTools)
$headers = [
    "User-Agent: Mozilla/5.0",
    "Accept: */*",
    "Connection: keep-alive",
    "Referer: https://live.mpk.czest.pl/",
    // Dodaj inne nagłówki, które widzisz w DevTools
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Wykonanie żądania
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo "Response: $response";
}

// Zamykanie sesji cURL
curl_close($ch);
?>