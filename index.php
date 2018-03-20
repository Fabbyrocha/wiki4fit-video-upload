<?php
require("./vendor/autoload.php");

$client_secret = '3ZzPSqMTnLsIMVkpjEiejfhPZl50Lxv3SELdP5uqbC6kw3As2SibxKoIq7cjXp/GGRxA2qx+GvtSOEvIeYMnRNUjtXJmpEYPvqrkiZkQzlPhPvQoJyCxRjk6KxTFCy1X';
$client_id = '2c7c9ecb09fb56212ccdd9130fd8bb140674f444';


//https://api.vimeo.com/oauth/authorize?client_id=XXXXX&response_type=code&redirect_uri=XXXX.YYY/ZZZZZ&state=XXXXXX 

$redirect_uri = 'http://wiki-lab.herokuapp.com/upload/index.php';

$scopes = 'public upload';
$states = 'baconpedacudo';

$config = require(__DIR__ . '/init.php');
$lib = new \Vimeo\Vimeo($config['client_id'], $config['client_secret']);
if (!empty($config['access_token'])) {
    $lib->setToken($config['access_token']);
    $user = $lib->request('/me');
} else {
    $user = $lib->request('/users/dashron');
}
//print_r($user);
echo '<pre>';
$response = $lib->request('/me/videos', ['per_page' => 2], 'GET');
print_r($response['body']['data']);


echo '<hr>';

$response = $lib->request('/videos/256852715', ['per_page' => 2], 'GET');
print_r($response);
