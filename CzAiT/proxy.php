<?php
    if (isset($_GET['type']) && isset($_GET['time'])){
        $type = $_GET['type'];
        $time = $_GET['time'];
        if ($type == "directions"){
            $url = "https://live.mpk.czest.pl/api/directions/".$time;
        }else if(isset($_GET['location'])){
            $location = $_GET['location'];
            if ($type == "location"){
                $url = "https://live.mpk.czest.pl/api/locations/".$location."/timetables/".$time;

            } else if ($type == "stops"){
                $url = "https://live.mpk.czest.pl/api/directions/full/".$time."/$location";
            } 
        }else{
            http_response_code(500);
            echo json_encode(['error' => 'Brakujące dane GET']);
        }


        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if($response === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Błąd w pobieraniu danych']);
        } else {
            header('Content-Type: application/json');
            echo $response;
        }

        curl_close($ch); 
    } else{
        http_response_code(500);
        echo json_encode(['error' => 'Brakujące dane GET']);
    }

?>