<?php
header("Access-Control-Allow-Origin: *");
include('./config/config.php');
require_once('helpers/edenai.php');

if ($_POST) {

    $number = $_POST['number'];
    $description = $_POST['description'];

    $rangeArray = range('010', '099');

    if (in_array($number, $rangeArray)) {
        $number = '0 ' . substr($number, 1);
    }

    $text = "Nomor Antrian, " . $number . ", Segera Menuju " . $description . ".";
    $speech = text_to_speech($text);

    $data = json_decode($speech, true);

    $mp3 = $data['google']['audio_resource_url'];

    $note = strtolower(str_replace(' ', '_', $description));

    $dir = './uploads/speeches/';
    $file = $note . '_' . str_replace(' ', '', $number) . '.mp3';

    $file_path = $dir . $file;
    file_put_contents($file_path, $mp3);

    $mp3 = $base_url . str_replace('./', '', $file_path);

    $response = array('file_path' => $mp3);

    $json_response = json_encode($response);

    echo $json_response;
} else {
    header('Location : index.php');
}
