<?php

$acceptableMimeTypes = [
    'image/png',
    'image/jpg',
    'image/jpeg',
    'image/gif',
];

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileType = image_type_to_mime_type(exif_imagetype($_FILES['file']['tmp_name']));

    if (in_array($fileType, $acceptableMimeTypes)) {
        $saneFilename = preg_replace('#[^a-zA-Z0-9\.\-_]#', '', $_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], '../images/' . random_int(0, 9999) . $saneFilename);
        header('location: /');
    }
}