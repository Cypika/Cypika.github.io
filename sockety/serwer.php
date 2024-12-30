<?php
    if (isset($_GET['sid'])){
        $sid = $_GET['sid'];
        $url = "https://live.mpk.czest.pl/socket.io/?EIO=3&transport=polling&t=46786d&sid=".$sid;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $cookies = "io=".$sid;
        
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if($response === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Błąd w pobieraniu danych']);
        } else {
            header('Content-Type: application/json');
            echo $url. $response;
        }

        curl_close($ch); 
    } else{
        http_response_code(500);
        echo json_encode(['error' => 'Brakujące dane GET']);
    }

?>