<?php
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoUploadException;

//$id_video = $_GET['id_video']?:'id_'.md5(date("Ymdgi"));
$config = require(__DIR__ . '/init.php');
if (empty($config['access_token'])) {
    throw new Exception(
        'You can not upload a file without an access token. You can find this token on your app page, or generate ' .
        'one using `auth.php`.'
    );
}

$lib = new Vimeo($config['client_id'], $config['client_secret'], $config['access_token']);

if(!isset($_POST['video_name']))
    return;
if(!isset($_POST['id_video']))
    return;
if(!isset($_POST['desc_video']))
    return;
$file_name =$_POST['video_name'];
$id_video =$_POST['id_video'];
$desc_video =$_POST['desc_video'];

try {

    $uri = $lib->upload($file_name, array(
        'name' => $id_video,
        'description' => $desc_video
    ));

    $video_data = $lib->request($uri . '?fields=link');


} catch (VimeoUploadException $e) {
    // We may have had an error. We can't resolve it here necessarily, so report it to the user.
    echo 'Error uploading ' . $file_name . "\n";
    echo 'Server reported: ' . $e->getMessage() . "\n";
} catch (VimeoRequestException $e) {
    echo 'There was an error making the request.' . "\n";
    echo 'Server reported: ' . $e->getMessage() . "\n";
}

unlink($file_name);
    echo $uri;