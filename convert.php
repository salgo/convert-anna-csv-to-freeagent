<?php

$row = 1;
$parsed = [];
$headers = [];

if ($argc < 3) {
    echo "Usage: php convert.php <input_file> <output_file>\n";
    exit(1);
}

if (($handle = fopen($argv[1], 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 100000, ",")) !== false) {
        if ($row === 1) {
            $headers = $data;
        } else {
            $parsed[] = array_combine($headers, $data);
        }
        $row++;
    }
    fclose($handle);
}

if (($out = fopen($argv[2], 'w')) !== FALSE) {
    foreach ($parsed as $row) {
        fputcsv($out, [
            $row['date'],
            $row['amount'],
            $row['description']
        ]);
    }
    fclose($out);
}