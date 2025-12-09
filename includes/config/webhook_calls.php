<?php

use Models\Tickets;

function notifyToWebhook($info, $event)
{


  $url = 'https://automations.asistentevirtualsas.com/webhook/9b358a33-4cae-4c2b-8d2c-c3a81173a2b6';

  $data = [
    'event' => $event
  ];

  foreach ($info as $key => $value) {

    $data[$key] = $value;
  }


  $options = [
    "http" => [
      "header"  => "Content-Type: application/json\r\n",
      "method"  => "POST",
      "content" => json_encode($data),
      "ignore_errors" => true // Permite capturar respuestas 4xx/5xx
    ]
  ];

  $context = stream_context_create($options);

  $response = file_get_contents($url, false, $context);

  echo $response;
}
