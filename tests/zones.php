<?php

use KopeechkaLib\KopeechkaApi;

include __DIR__ . "/../vendor/autoload.php";

try {
    $token = '';
    $api_version = '2';
    $response_type = 'text';

    $kopeechka = new KopeechkaApi($token, $api_version, $response_type);

    $response_domains = $kopeechka
        ->mailbox()
        ->zones(true, 'test.com');

    if ($response_domains) {
        $response_domains = json_decode($response_domains, true);

        echo print_r($response_domains['zones'], 1);
    } else {
        throw new Exception("\nEmpty response_balance");
    }
} catch (Exception $e) {
    die($e->getMessage());
}


