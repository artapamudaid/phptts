<?php

function text_to_speech(String $text)
{

    require_once('./helpers/constant.php');

    require_once('./vendor/autoload.php');

    $client = new \GuzzleHttp\Client();


    $response = $client->request('POST', 'https://api.edenai.run/v2/audio/text_to_speech', [
        'body' => '{"response_as_dict":true,"attributes_as_list":false,"show_original_response":false,"rate":0,"pitch":0,"volume":0,"sampling_rate":0,"providers":"google","language":"id","text":"' . $text . '","option":"FEMALE"}',
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . EDENAI_KEY,
            'content-type' => 'application/json',
        ],
    ]);

    return $response->getBody();
}
