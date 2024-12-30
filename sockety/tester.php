<?php

// Otrzymany wcześniej `sid`
$sid = "rd8SazepAVAa2sbFAquk";

$url = "https://live.mpk.czest.pl/socket.io/?EIO=3&transport=polling&t=PAaQzsN&sid=$sid";

// Inicjalizacja sesji cURL
$ch = curl_init($url);

// Ustawienie nagłówków (skopiuj je z DevTools, jeśli są potrzebne)
$headers = [
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36",
    "Accept: */*",
    "Connection: keep-alive",
    "Referer: https://live.mpk.czest.pl/",
    "Cookie: io=rd8SazepAVAa2sbFAquk",
    // Dodaj inne nagłówki, które są potrzebne
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Ustawienie opcji, aby otrzymać odpowiedź jako string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Wykonanie żądania
$response = curl_exec($ch);

// Sprawdzenie, czy wystąpił błąd
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo $response; // Tutaj zobaczysz odpowiedź JSON
}

// Zamykanie sesji cURL
curl_close($ch);
?>