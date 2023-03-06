# Validator

Groovey Validator Package

## Installation

    $ composer require groovey/validator

## Usage

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Silex\Application;
use Groovey\Validator\Providers\ValidatorServiceProvider;

$app = new Application();
$app['debug'] = true;

$app->register(new ValidatorServiceProvider());

$input = [
    'first_name'            => 'John',
    'last_name'             => 'Doe',
    'email'                 => 'john@doe.com',
    'password'              => '12345678',
    'password_confirmation' => '12345678',
];

$rules = [
    'first_name' => 'required|alpha|max:10',
    'last_name'  => 'required|alpha|max:100',
    'email'      => 'required|email',
    'password'   => 'required|min:8|confirmed',
];

$validator = $app['validator']->make($input, $rules);
$status    = $validator->passes();

if ($status) {

} else {
    $errors = $validator->errors();
    dump($errors);
}
```


## Documentation

   * [Laravel Validation](https://laravel.com/docs/master/validation)


