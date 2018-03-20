<?php

$uploaddir = md5(date("Ymdgi"));
$uploadfile = $uploaddir .'_'. basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo '<pre>Use esse Id para achar seu video e enviar para o Vimeo<br>';
    echo '<strong>'.$uploadfile.'</strong>';
} else {
    echo "Possível ataque de upload de arquivo!\n";
}

print "</pre>";
?>