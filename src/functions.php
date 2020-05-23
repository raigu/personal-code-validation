<?php

namespace Raigu;

function is_valid_person_code(string $code): bool
{
    return PersonalCodeValidation::create($code)->valid();
}

function person_code_control_number(string $code): int
{
    // @source https://et.wikipedia.org/wiki/Isikukood#Kontrollnumber
    // @source http://www.cs.tlu.ee/~inga/progbaas/Praktiline/isikukood.txt
    $sum = 0;
    for ($i = 0; $i < 10; $i++) {
        $d = intval(substr($code, $i, 1));
        $w = ($i % 9) + 1;
        $sum += $d * $w;
    }

    $modulo = $sum % 11;

    if ($modulo === 10) {
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $d = intval(substr($code, $i, 1));
            $w = (($i + 2) % 9) + 1;
            $sum += $d * $w;
        }

        $modulo = $sum % 11;

        if ($modulo === 10) {
            $modulo = 0;
        }
    }

    return $modulo;
}