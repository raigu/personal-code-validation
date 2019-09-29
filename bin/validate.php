<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Raigu\PersonalCodeValidation;

if ($argc !== 2) {
    echo "Estonian personal identification code validation.\n";
    echo "Usage: php ./bin/validation.php <id>\n";
    exit(1);
} else {
    $id = $argv[1];
}

echo "{$id}...";

$validation = PersonalCodeValidation::create(
    $id
);

if ($validation->valid()) {
    echo "OK\n";
    exit(0);
} else {
    echo "Invalid!\n";
    exit(1);
}