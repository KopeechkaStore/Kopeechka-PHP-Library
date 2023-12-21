<?php

use KopeechkaLib\KopeechkaApi;

include __DIR__ . "/../vendor/autoload.php";

try {
    $token = '';
    $api_version = '2';
    $response_type = 'json';

    $kopeechka = new KopeechkaApi($token, $api_version,$response_type);

    $response_balance = $kopeechka
        ->user()
        ->balance();

    if ($response_balance) {
        $response_balance = json_decode($response_balance, true);
    } else {
        throw new Exception("\nEmpty response_balance");
    }

    if ($response_balance['status'] == 'OK') {
        echo 'My balance is ' . $response_balance['balance'];
    } else {
        throw new Exception("\nBad balance");
    }
} catch (Exception $e) {
    die($e->getMessage());
}