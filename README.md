[![Latest Stable Version](https://poser.pugx.org/raigu/personal-code-validation/v/stable)](https://packagist.org/packages/raigu/personal-code-validation)
[![GitHub license](https://img.shields.io/github/license/raigu/personal-code-validation)](LICENSE.md)
[![Total Downloads](https://poser.pugx.org/raigu/personal-code-validation/downloads)](https://packagist.org/packages/raigu/personal-code-validation)
[![build](https://github.com/raigu/personal-code-validation/workflows/build/badge.svg)](https://github.com/raigu/personal-code-validation/actions?query=workflow%3Abuild)
[![codecov](https://codecov.io/gh/raigu/personal-code-validation/branch/master/graph/badge.svg)](https://codecov.io/gh/raigu/personal-code-validation)

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
