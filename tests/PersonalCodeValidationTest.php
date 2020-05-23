<?php

namespace Raigu;

use PHPUnit\Framework\TestCase;

final class PersonalCodeValidationTest extends TestCase
{
    /**
     * @test
     */
    public function stub()
    {
        $sut = PersonalCodeValidation::stub();
        $this->assertInstanceOf(
            PersonalCodeValidation::class,
            $sut
        );
    }

    /**
     * @test
     */
    public function constructed_from_string()
    {
        $sut = PersonalCodeValidation::create('47101010033');
        $this->assertInstanceOf(
            PersonalCodeValidation::class,
            $sut
        );
    }

    /**
     * @test
     */
    public function constructed_from_closure()
    {
        $regCode = '47101010033';
        $sut = PersonalCodeValidation::fromClosure(function () use ($regCode) {
            return $regCode;
        });

        $this->assertInstanceOf(
            PersonalCodeValidation::class,
            $sut
        );
    }

    /**
     * @test
     */
    public function valid()
    {
        $sut = PersonalCodeValidation::stub();
        $this->assertIsBool(
            $sut->valid()
        );
    }

    /**
     * @test
     * @testdox Sample from standard EVS 585:2007 passes
     */
    public function sample_from_standard_passes()
    {
        $this->assertTrue(
            is_valid_person_code('32708101201')
        );
    }

    /**
     * @test
     * @testdox Sample from standard EVS 585:2007 having modulo 10 passes
     */
    public function sample_from_standard_having_modulo_10_passes() {
        $this->assertTrue(
            is_valid_person_code('46304280206')
        );
    }

    /**
     * @test
     */
    public function empty_string_is_invalid()
    {
        $this->assertFalse(
            is_valid_person_code('')
        );
    }

    /**
     * @test
     */
    public function non_numeric_string_is_invalid()
    {
        $this->assertFalse(
            is_valid_person_code('ABCDEFGHIJK')
        );
    }

    /**
     * @test
     */
    public function code_with_invalid_control_number_is_invalid()
    {
        $this->assertFalse(
            is_valid_person_code('47101010030')
        );
    }

    /**
     * @test
     * @testdox Validates sex and centuries according to standard EVS 585:2007
     * @dataProvider sampleSexAndCentury
     */
    public function validates_sex_and_centuries_according_standard(bool $expected, string $code)
    {
        $this->assertEquals(
            $expected,
            is_valid_person_code($code)
        );
    }

    /**
     * @test
     * @dataProvider sampleBirthDate
     */
    public function validates_birth_date(bool $expected, string $code)
    {
        $sut = PersonalCodeValidation::create($code);
        $this->assertEquals(
            $expected,
            $sut->validBirthDate()
        );
    }

    /**
     * @test
     */
    public function fakeTrue()
    {
        $sut = PersonalCodeValidation::fakeTrue();
        $this->assertTrue(
            $sut->valid()
        );
    }

    /**
     * @test
     */
    public function fakeFalse()
    {
        $sut = PersonalCodeValidation::fakeFalse();
        $this->assertFalse(
            $sut->valid()
        );
    }

    public function sampleSexAndCentury()
    {
        return [
            'Invalid' => [false, '00101010004'],
            'Male born on 19th century' => [true, '10101010005'],
            'Female born on 19th century' => [true, '20101010006'],
            'Male born on 20th century' => [true, '30101010007'],
            'Female born on 20th century' => [true, '40101010008'],
            'Male born on 21th century' => [true, '50101010009'],
            'Female born on 21th century' => [true, '60101010006'],
            'Invalid, first number bigger than mentioned in standard' => [false, '70101010000'],
        ];
    }

    public function sampleBirthDate()
    {
        return [
            'Invalid date' => [false, '600000000006'],
            'Valid date #1' => [true, '679123100009'],
            'Valid date #2' => [true, '601010200006'],
        ];
    }
}
