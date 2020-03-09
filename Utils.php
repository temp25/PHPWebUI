<?php
    
    require_once("downloadFile.php");

    function getTimestamp() {
        list($seconds_fractional, $seconds_integral) = explode(" ", microtime());
        $milli_seconds = (int) $seconds_integral.substr($seconds_fractional, 2, 3);
        return (int) $milli_seconds;
    }

    function sendData($data) {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
?>