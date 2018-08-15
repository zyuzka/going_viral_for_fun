<?php

if (strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) < 8) {
    $saneFileName = preg_replace('#[^a-zA-Z0-9\.\-_]#', '', $_GET['filename']);
    $saneFileName = '../images/' . $saneFileName;

    $fileType = image_type_to_mime_type(exif_imagetype($saneFileName));
    header('Content-Type: ' . $fileType);
    include $saneFileName;
}
