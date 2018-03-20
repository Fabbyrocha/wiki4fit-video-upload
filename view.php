<?php
require("./vendor/autoload.php");

$video = $_GET['video_id'];

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

$response = $lib->request($video, ['per_page' => 2], 'GET');
print_r($response);