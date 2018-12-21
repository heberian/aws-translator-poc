<?php
/**
 * Copyright 2010-2018 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * This file is licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License. A copy of
 * the License is located at
 *
 * http://aws.amazon.com/apache2.0/
 *
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
 *
 *  ABOUT THIS PHP SAMPLE: This sample is part of the SDK for PHP Developer Guide topic at
 * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/iam-examples-working-with-policies.html
 *
 */
require 'vendor/autoload.php';

use Aws\Translate\TranslateClient;
use Aws\Exception\AwsException;

/**
 * Translate a text from Arabic (ar), Chinese (Simplified) (zh)
 * French (fr), German (de), Portuguese (pt), or Spanish (es) 
 * into English (en) with Translate client.
 *
 * This code expects that you have AWS credentials set up per:
 * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials.html
 */

//Create a Translate Client
$client = new Aws\Translate\TranslateClient([
    'profile' => 'default',
    'region' => 'us-west-2',
    'version' => '2017-07-01'
]);

  $from=$_POST["from"];
  $to=$_POST["to"];
  $trans=$_POST["trans"];
   

// Arabic (ar), Chinese (Simplified) (zh), English (en)
// French (fr), German (de), Portuguese (pt), or Spanish (es) 

$currentLanguage = $from;

// If the TargetLanguageCode is not "en", the SourceLanguageCode must be "en".
$targetLanguage= $to;


$textToTranslate = $trans;

try {
    $result = $client->translateText([
        'SourceLanguageCode' => 'auto',
        'TargetLanguageCode' => $targetLanguage, 
        'Text' => $textToTranslate, 
    ]);

    $cou=array();

     $cou['data']=$result->get('TranslatedText');
     $cou['data1']=$result->get('SourceLanguageCode');
     
      echo json_encode($cou);
    //  var_dump(json_encode($cou));

}catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}



