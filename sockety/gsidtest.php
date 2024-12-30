<?php
// URL do uzyskania sid
$url = "https://live.mpk.czest.pl/socket.io/?EIO=3&transport=polling";

// Włącz raportowanie błędów
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicjalizacja cURL dla pierwszego zapytania
$ch = curl_init();

// Ustawienia cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Wykonaj pierwsze zapytanie
$response = curl_exec($ch);

// Sprawdź błędy cURL
if (curl_errno($ch)) {
    die('Błąd cURL: ' . curl_error($ch));
}

// Zamknij cURL
curl_close($ch);

// Sprawdź odpowiedź
if ($response === FALSE) {
    die('Błąd podczas pobierania danych.');
}

// Wyświetl pobraną odpowiedź
echo "Odpowiedź z serwera: " . $response . "\n";

// Wyodrębnij SID z odpowiedzi
preg_match('/sid":"(.*?)"/', $response, $matches);
if (isset($matches[1])) {
    $sid = $matches[1];
    echo "Otrzymany SID: " . $sid . "\n";
} else {
    die('Nie udało się uzyskać SID.');
}

// Teraz wykonaj drugie zapytanie z SID
$url_with_sid = "https://live.mpk.czest.pl/socket.io/?EIO=3&transport=polling&t=PAaQzsN&sid=" . $sid;

// Inicjalizacja cURL dla drugiego zapytania
$ch = curl_init();

// Ustawienia cURL
curl_setopt($ch, CURLOPT_URL, $url_with_sid);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
    'Accept: application/json',
]);

// Wykonaj drugie zapytanie
$response_with_sid = curl_exec($ch);

// Sprawdź błędy cURL
if (curl_errno($ch)) {
    die('Błąd cURL przy pobieraniu danych z SID: ' . curl_error($ch));
}

// Zamknij cURL
curl_close($ch);

// Sprawdź odpowiedź z drugim zapytaniem
if ($response_with_sid === FALSE) {
    die('Błąd podczas pobierania danych z SID.');
}

// Wyświetl pobraną odpowiedź
echo "Odpowiedź z serwera z SID: " . $response_with_sid . "\n";
?>
