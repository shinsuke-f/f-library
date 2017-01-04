<?php

$base_url = "url";

$service_id = "aaaa";
$product_id = "48976";
$order_id = "567895";

$data = array(
    'service_id' => $service_id,
    'product_id' => $product_id,
    'order_id'   => $order_id,
);

$options = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_PRETTY_PRINT;

$context = stream_context_create(
    array(
        'http' => array(
            'method'=> 'POST',
            'header'=> 'Content-type: application/json; charset=UTF-8',
            'content' => json_encode($data, $options),
            'ignore_errors' => true,
        )
    )
);

$result = file_get_contents($base_url.'/api/v1/purchases', false, $context);
$result = json_decode($result, true);

var_export($result);

preg_match('/HTTP\/1\.[0|1|x] ([0-9]{3})/', $http_response_header[0], $matches);
$status_code = $matches[1];

//$status_codeが201ならOKそれ以外はNG
echo ($status_code==201);
