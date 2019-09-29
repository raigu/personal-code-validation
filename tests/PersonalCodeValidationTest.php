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
     */
    public function valid_regression()
    {
        $this->assertValid('32708101201'); // Sample from standard EVS 585:2007
        $this->assertValid('46304280206'); // Sample from standard EVS 585:2007, modulo == 10

        $this->assertInvalid('');
        $this->assertInvalid('ABCDEFGHIJK');
        $this->assertInvalid('47101010030'); // invalid control number
        $this->assertInvalid('12213008'); // valid company registry code

        $this->assertValid('47101010033'); // value used in stub
    }

    /**
     * @test
     * @dataProvider sampleSexAndSentury
     */
    public function validSexAndCentury(bool $expected, string $code)
    {
        $sut = PersonalCodeValidation::create($code);
        $this->assertEquals(
            $expected,
            $sut->validSexAndCentury()
        );
    }

    /**
     * @test
     * @dataProvider sampleBirthDate
     */
    public function validateBirthDate(bool $expected, string $code)
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


    private function assertValid($code)
    {
        $sut = PersonalCodeValidation::create($code);
        $this->assertTrue(
            $sut->valid(),
            sprintf('%s is expected to be valid.', $code)
        );
    }

    private function assertInvalid($code)
    {
        $sut = PersonalCodeValidation::create($code);
        $this->assertFalse(
            $sut->valid(),
            sprintf('"%s" is expected to be invalid.', $code)
        );
    }

    public function sampleSexAndSentury()
    {
        return [
            'Invalid' => [false, '0000000000'],
            'Male born on 19th century' => [true, '10000000000'],
            'Female born on 19th century' => [true, '20000000000'],
            'Male born on 20th century' => [true, '30000000000'],
            'Female born on 20th century' => [true, '40000000000'],
            'Male born on 21th century' => [true, '50000000000'],
            'Female born on 21th century' => [true, '60000000000'],
            'Invalid, first number bigger than mentioned in standard' => [false, '70000000000'],
        ];
    }

    public function sampleBirthDate()
    {
        return [
            'Invalid date' => [false, '600000000000'],
            'Valid date' => [true, '679123100000'],
            'Valid date' => [true, '601010200000'],
        ];
    }
}
