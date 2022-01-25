<?php

if (!isset($_REQUEST)) {
    return;
}

$session = $_GET["sessionID"];
$type = $_GET["isLock"];
$file = fopen('file.txt', 'r+');

setlocale(LC_ALL, 'ru_RU.utf8');

switch ($type) {
    case "true":
        $session = $_GET["sessionID"];
        fwrite($file, (string)$session);
        fclose($file);
        $answer = ["sessionID" => (string)$session];
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
        break;
    case "false":
        /* или */
        $filename = __DIR__ . '/file.txt';
        $array = file($filename);
        $session_check = ["message" => $array[0]];
        if ($session == $session_check) {
            $answer = ["isLock" => "False"];
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($answer, JSON_UNESCAPED_UNICODE);
        }
        break;
}