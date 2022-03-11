<?php

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://api-m.paypal.com/v2/checkout/orders/6U544256GG886104J/capture",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer {A21AALFyatjgx51T5a6cbCh6m0NjFzMEIxXsEy83v1Sk4kf_lzdHV6OrkBPzgPXS-lrkZEicworSoPkJMLhb05I5ol0HNl3ew}",
    "Content-Type: application/json"
),
));
$response = curl_exec($curl);
echo $response;
$err = curl_error($curl);
echo $err;
curl_close($curl);

?>