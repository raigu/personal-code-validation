<?php

namespace Raigu;

use Closure;

final class PersonalCodeValidation
{
    /**
     * @var Closure
     */
    private $closure;

    public function valid(): bool
    {
        $code = call_user_func($this->closure);

        if (strlen($code) !== 11) {
            return false;
        }

        if (!preg_match('/^[0-9]{11}$/', $code)) {
            return false;
        }

        if ($this->controlNumber($code) !== intval($code[-1])) {
            return false;
        }

        if (!$this->validSexAndCentury()) {
            return false;
        }

        if (!$this->validBirthDate()) {
            return false;
        }

        return true;
    }

    private function controlNumber(string $code): int
    {
        // @source https://et.wikipedia.org/wiki/Isikukood#Kontrollnumber
        // @source http://www.cs.tlu.ee/~inga/progbaas/Praktiline/isikukood.txt
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $d = intval(substr($code, $i, 1));
            $w = ($i % 9)+1;
            $sum += $d*$w;
        }

        $modulo = $sum % 11;

        if ($modulo === 10) {
            $sum = 0;
            for ($i = 0; $i < 10; $i++) {
                $d = intval(substr($code, $i, 1));
                $w = (($i+2) % 9)+1;
                $sum += $d*$w;
            }

            $modulo = $sum % 11;

            if ($modulo === 10) {
                $modulo = 0;
            }
        }

        return $modulo;
    }

    public function validSexAndCentury()
    {
        $code = call_user_func($this->closure);

        $d = intval(substr($code, 0, 1));
        return (1 <= $d) and ($d <= 6);
    }

    public function validBirthDate()
    {
        $code = call_user_func($this->closure);

        $year = substr($code, 1, 2);
        $year = intval($year);
        $d = (int)substr($code, 0, 1);
        // Make full year
        $year = 1800 + (int)floor(($d-1)/2)*100 + $year;

        $month = substr($code, 3, 2);
        $month = ltrim($month, '0');
        $month = intval($month);

        $day = substr($code, 5, 2);
        $day = ltrim($day, '0');
        $day = intval($day);

        return checkdate($month, $day, $year);
    }

    public static function create(string $code): self
    {
        return new self(function () use ($code) {
            return $code;
        });
    }

    private function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }
}
