<?php

use KopeechkaLib\KopeechkaApi;

include __DIR__ . "/../vendor/autoload.php";

try {
    $token = '';
    $api_version = '2';
    $response_type = 'json';

    $kopeechka = new KopeechkaApi($token, $api_version,$response_type);

    $site = 'test.com';
    $mail_type = 'all';
    $password = 0;
    $regex = null;
    $subject = null;
    $investor = null;
    $soft = null;

    $response_get_email = $kopeechka
        ->mailbox()
        ->getEmail($site, $mail_type, $password, $regex, $subject, $investor, $soft);

    if ($response_get_email) {
        $response_get_email = json_decode($response_get_email, true);
    } else {
        throw new Exception("\nEmpty response_get_email");
    }

    $email = null;
    $id = null;

    if ($response_get_email['status'] == 'OK') {
        $email = $response_get_email['mail'];
        $id = $response_get_email['id'];

        echo "\n" . $response_get_email['mail'];
    } else {
        throw new Exception("\nBad response " . $response_get_email['value']);
    }

    while($response_get_message = $kopeechka->mailbox()->getMessage($id)) {

        if ($response_get_email) {
            $response_get_message = json_decode($response_get_message, true);
        } else {
            throw new Exception("\nEmpty response_get_message");
        }

        if ($response_get_message['status'] == 'OK') {
            exit("\n" . $response_get_message['fullmessage']);
        } elseif ($response_get_message['value'] == 'WAIT_LINK') {
            echo "\nwait message ...";
            sleep(5);
        } else {
            throw new Exception("\nNo message. Email canceled");
        }
    }

} catch (Exception $e) {
    die($e->getMessage());
}


