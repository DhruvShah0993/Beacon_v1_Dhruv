<?php
/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAxhBdXxo:APA91bH69PMwVOdylKxmO9UpVx2Wc86wg1fz-zYLqqsI6V6BvryrwW08ofDCZmBgPbY_nSSstiIAVWoEvljiV7uBjZISqZR8IEHeJxW0nc7dzpW6hUsjiOYo55TpkEUlaqZlOl-BSC0T',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
