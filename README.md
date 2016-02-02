# Slick Validator package

[![Latest Version](https://img.shields.io/github/release/slickframework/validator.svg?style=flat-square)](https://github.com/slickframework/validator/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/slickframework/validator/master.svg?style=flat-square)](https://travis-ci.org/slickframework/validator)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/slickframework/validator/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/slickframework/validator/code-structure?branch=master)
[![Quality Score](https://img.shields.io/scrutinizer/g/slickframework/validator/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/slickframework/validator?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/slick/validator.svg?style=flat-square)](https://packagist.org/packages/slick/validator)

`Slick/Validator` is a set of input validation tools that can be used to check your input data.
It also has the concept of _Validation Chain_ that can combine validators for a specifica validation.

This package is compliant with PSR-2 code standards and PSR-4 autoload standards. It
also applies the [semantic version 2.0.0](http://semver.org) specification.

## Install

Via Composer

``` bash
$ composer require slick/validator
```

## Usage

One of the easiest ways of using a validator is using `StaticValidator` class to check a value:
```php
use Slick\Validator\StaticValidator;

if (StaticValidator::validates('notEmpty', $value) {
  // Some code with valid value
} else {
  print StaticValidator::getMessage(); // Print out validation messages
}

```

`Slick/Validator` comes with the following validators:

Alias      | Description                              | Class
:---------:|------------------------------------------|---------------------------
_notEmpty_ | Fails if passed value is an empty string | `Slick\Validator\NotEmpty`
_email_    | Fails if passed value is not a valid e-mail address | `Slick\Validator\Email`
_number_   | Fails if passed value is not am integer number | `Slick\Validator\Number`
_alphaNumeric_ | Fails if passed value is not an alpha numeric value | `Slick\Validator\AlphaNumeric`
_url_ | Fails if passed value is not an URL | `Slick\Validator\URL`

`StaticValidator` is also a validator objects factory. For example:
```php
use Slick\Validator\StaticValidator;

$urlValidator = StaticValidator::create('notEmpty', 'You must enter a valid URL.');

if ($urlValidator->validates($_POST['url']) {
    // URL is valid use it...
} else {
    print $urlValidator->getMessage(); // Will print out 'You must enter a valid URL.'
}

```

Combining various validator to use it as a single validation can be done with
`ValidatorChain`.

```php
use Slick\Validator\StaticValidator;
use Slick\Validator\ValidatorChain;

$emailValidation = new ValidatorChain();
$emailValidation
    ->add(StaticValidator::create('notEmpty', 'Email address cannot be empty.'))
    ->add(StaticValidator::create('email', 'The entered e-mail is not a valid address.');
    
if ($emailValidation->isValid($_POST['email']) {
    // URL is valid use it...
} else {
    print implode(', ', $emailValidation->getMessages()); 
    // Will print out the validation messages for the validator(s) that fail.
}    

``` 

You can always create your own validator and use the `StaticValidator` or the `ValidationChain` as long
as you implement the `Slick\Validator\ValidatorInterface` or `Slick\Validator\ValidationChainInterface`.

## Testing

``` bash
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email silvam.filipe@gmail.com instead of using the issue tracker.

## Credits

- [Slick framework](https://github.com/slickframework)
- [All Contributors](https://github.com/slickframework/common/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
