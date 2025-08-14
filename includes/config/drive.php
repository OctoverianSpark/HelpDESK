<?php

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

   function connect2Drive(){

      $API_INFO = json_decode(file_get_contents(__DIR__ . "/../data/gapi.json"));
      

      $ACCOUNT = json_decode(file_get_contents(__DIR__ . "/../data/service.json"));
      
      
      $client = new Client();
      $client->setAuthConfig(__DIR__ . "/../data/service.json");
      $client->setScopes([Drive::DRIVE]);


      return $client;

   }


   function saveData($file,$parent = '1nuTmqj-4EDISnuoAzaPhrIbWvDaPvuEk'){

      $service = new Drive(connect2Drive());


      $fileName = basename($file);

      $fileMetadata = new DriveFile([
         "name"=>$fileName,
         "parents"=>[$parent]
      ]);

      
      $content = file_get_contents($file);


      $file = $service->files->create($fileMetadata,[
         "data"=>$content,
         "mimeType"=>mime_content_type($file),
         "uploadType"=>'multipart'
      ]);


      return $file->id;

   }



   

