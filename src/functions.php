<?php

namespace Raigu;

if (!function_exists('Raigu\is_valid_personal_code')) {

    function is_valid_personal_code(string $code): bool
    {
        if (strlen($code) !== 11) {
            return false;
        }

        if (!preg_match('/^[0-9]{11}$/', $code)) {
            return false;
        }

        if (personal_code_control_number($code) !== intval($code[-1])) {
            return false;
        }

        // sex and century validation
        $d = intval(substr($code, 0, 1));
        if ($d < 1 || 6 < $d) {
            return false;
        }

        // date of birth validation
        $year = substr($code, 1, 2);
        $year = intval($year);
        $d = (int)substr($code, 0, 1);
        // Make full year
        $year = 1800 + (int)floor(($d - 1) / 2) * 100 + $year;

        $month = substr($code, 3, 2);
        $month = ltrim($month, '0');
        $month = intval($month);

        $day = substr($code, 5, 2);
        $day = ltrim($day, '0');
        $day = intval($day);

        if (!checkdate($month, $day, $year)) {
            return false;
        }

        return true;
    }
}

if (!function_exists('Raigu\personal_code_control_number')) {

    function personal_code_control_number(string $code): int
    {
        // @source https://www.evs.ee/en/evs-585-2007
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
}