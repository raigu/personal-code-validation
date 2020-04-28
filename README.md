[![Latest Stable Version](https://poser.pugx.org/raigu/personal-code-validation/v/stable)](https://packagist.org/packages/raigu/personal-code-validation)
[![GitHub license](https://img.shields.io/github/license/raigu/personal-code-validation)](LICENSE.md)

# Estonian person identification code validation

Validation of Estonian natural person identification code according to the 
standard [EVS 585:2007 Personal code. Structure](https://www.evs.ee/products/evs-585-2007).

I created this package because I needed a validation that states it fallows an official standard.  
I bought the standard from Estonian Centre for Standardisation and worked it through. 

# Install 

````bash
$ composer require raigu/personal-code-validation
````

# Usage 

```php
use Raigu\PersonalCodeValidation;

$validation = PersonalCodeValidation::create('47101010033');

// Check validity
if ($validation->valid()) {
    echo 'Valid personal identification code';
} else {
    echo 'Invalid personal identification code';  
}
```

# Command Line Interface

```bash
$ php ./bin/validate.php
```

Will take codes from stdin and print out if it is valid or not.

Example:
 
```bash
$ echo 47101010033 | php ./bin/validate.php
47101010033...OK
```

You can validate codes in a file this way:

```bash
$ cat codes.txt | php ./bin/validate.php 
00000000000...Invalid!
47101010033...OK!
```

`codes.txt` must contain persona codes, one code per line.

# Testing

```bash
$ composer test
```

# Code coverage

```bash
composer coverage
```

# Plans

* extend the class `Raigu\PersonalCodeValidation` so it can also say why code is invalid

# License

Licensed under [MIT](LICENSE.md)
