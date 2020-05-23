[![Latest Stable Version](https://poser.pugx.org/raigu/personal-code-validation/v/stable)](https://packagist.org/packages/raigu/personal-code-validation)
[![GitHub license](https://img.shields.io/github/license/raigu/personal-code-validation)](LICENSE.md)
[![Total Downloads](https://poser.pugx.org/raigu/personal-code-validation/downloads)](https://packagist.org/packages/raigu/personal-code-validation)
[![build](https://github.com/raigu/personal-code-validation/workflows/build/badge.svg)](https://github.com/raigu/personal-code-validation/actions?query=workflow%3Abuild)
[![codecov](https://codecov.io/gh/raigu/personal-code-validation/branch/master/graph/badge.svg)](https://codecov.io/gh/raigu/personal-code-validation)

# Estonian person identification code validation

Validation of Estonian personal identification code according to the 
standard [EVS 585:2007 Personal code. Structure](https://www.evs.ee/products/evs-585-2007).

# Motivation

I needed a validation that states it fallows the official standard. 
I bought the standard from Estonian Centre for Standardisation and worked it through. 

# Install 

````bash
$ composer require raigu/personal-code-validation
````

# Usage 


```php
require_once 'vendor/autoload.php';

if (\Raigu\is_valid_personal_code('00000000000')) {
    echo "Valid\n";
} else {
    echo "Invalid\n";
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

# License

Licensed under [MIT](LICENSE.md)
