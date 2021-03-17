#!/usr/bin/env php
<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

function assert_valid($code, $message)
{
    echo $message . '...';
    if (!\Raigu\is_valid_personal_code($code)) {
        throw new Exception("Expected '{$code}' to be valid, but is_valid_personal_code returned false");
    }
    echo "OK.\n";
}

function assert_not_valid($code, $message)
{
    echo $message . '...';
    if (\Raigu\is_valid_personal_code($code)) {
        throw new Exception("Expected '{$code}' not to be valid, but is_valid_personal_code returned true.");
    }
    echo "OK.\n";
}

assert_valid('32708101201', 'Sample from standard EVS 585:2007');
assert_valid('46304280206', 'Sample from standard EVS 585:2007. Covers modulo 10 branch.');
assert_not_valid('', 'Empty string is invalid');
assert_not_valid('ABCDEFGHIJK', 'Non-numeric string is invalid');
assert_not_valid('47101010030', 'Cope with invalid control number is invalid.');

echo "Validates birth date...";
assert_not_valid('60000000006', '    ...invalid date');
assert_valid('67912310009', '    ...valid date #1');
assert_valid('60101020006', '    ...valid date #2');

echo "Validates sex and centuries according to standard EVS 585:2007...\n";
assert_not_valid('00101010004', '    ...no century');
assert_valid('10101010005', '    ...male born on 19th century');
assert_valid('20101010006', '    ...female born on 19th century');
assert_valid('30101010007', '    ...male born on 20th century');
assert_valid('40101010008', '    ...female born on 20th century');
assert_valid('50101010009', '    ...male born on 21th century');
assert_valid('60101010006', '    ...female born on 21th century');
assert_not_valid('70101010000', '    ...first number bigger than mentioned in standard');
