<?php
require_once('helpers/edenai.php');
$nomor = "001";
$text = "Nomor Antrean " . $nomor . " Segera Menuju Loket Pendaftaran";
$speech = text_to_speech($text);

$data = json_decode($speech, true);

$mp3 = $data['google']['audio_resource_url'];

$dir = './uploads/speeches/';
$file = 'pendaftaran_' . $nomor . '.mp3';

$file_path = $dir . $file;
file_put_contents($file_path, $mp3);

return $file_path;
