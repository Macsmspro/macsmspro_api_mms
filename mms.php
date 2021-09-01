<?php

$url = "https://macsmspro.com/api/mms.php";


$fields = array(
    
    "name" => "xxxxxx", // à remplacer par le nom du message
    "telephone" => "229xxxxxxxx", // à remplacer par le numéro du destinataire
    "message" => "Mon message", // à remplacer par le message à envoyer
    "token" => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx", // à remplacer par votre token 
    "files" => array(
        "url_image_1",
        ...
        "url_image_n",
    )
);



$curl_options = array(
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query( $fields ),
    CURLOPT_HTTP_VERSION => 1.0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false
);

$curl = curl_init();
curl_setopt_array( $curl, $curl_options );
$result = curl_exec( $curl );

curl_close( $curl );



$response = json_decode($result);

echo "<pre>";
var_dump($response);
echo "</pre>";

?>
