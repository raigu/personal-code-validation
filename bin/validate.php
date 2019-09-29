<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Raigu\PersonalCodeValidation;

while ($code = fgets(STDIN)) {
    $code = trim($code);

    echo "{$code}...";

    $validation = PersonalCodeValidation::create(
        $code
    );

    if ($validation->valid()) {
        echo "OK\n";
    } else {
        echo "Invalid!\n";
    }
}
