[![Latest Stable Version](https://poser.pugx.org/raigu/personal-code-validation/v/stable)](https://packagist.org/packages/raigu/personal-code-validation)
[![GitHub license](https://img.shields.io/github/license/raigu/personal-code-validation)](LICENSE.md)
[![Total Downloads](https://poser.pugx.org/raigu/personal-code-validation/downloads)](https://packagist.org/packages/raigu/personal-code-validation)
[![build](https://github.com/raigu/personal-code-validation/workflows/build/badge.svg)](https://github.com/raigu/personal-code-validation/actions?query=workflow%3Abuild)

# Estonian person identification code validation

Validation of Estonian personal identification code according to the 
standard [EVS 585:2007 Personal code. Structure](https://www.evs.ee/products/evs-585-2007).

# Compatibility

PHP 7.0, 7.1, 7.2, 7.3, 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5

# Motivation

I needed a validation that states it fallows the official standard. I bought the standard from Estonian Centre for Standardisation and worked it through. 

I needed a package with long time support. It has no other dependencies and is tested against all supported PHP versions in [GitHub Action](https://github.com/raigu/personal-code-validation/actions).

# Install 

````bash
$ composer require raigu/personal-code-validation
````

# Usage 

Validation of personal code:

```php
require_once 'vendor/autoload.php';

if (\Raigu\is_valid_personal_code('00000000000')) {
    echo "Valid\n";
} else {
    echo "Invalid\n";
}
```

Calculation of personal code's control number:

```php
echo \Raigu\personal_code_control_number('1234567890') . "\n";
echo \Raigu\personal_code_control_number('12345678901') . "\n";
```
will output:

```text
2
2
```

# Testing

```bash
$ composer test
```

# License

Licensed under [MIT](LICENSE.md)
