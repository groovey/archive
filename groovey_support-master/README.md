# Support
Groovey Support Package

## Installation

    $ composer require groovey/support

## Usage

```php

$trace = $app->get('trace')->getInstance();
$trace->show(true);
$trace->debug('test');
```

## Test Cases

Visit the test cases for more examples.

    $ phpunit ./tests
    $ phpunit ./tests/DateTest.php

## Supported Libraries

   * [Carbon](https://github.com/briannesbitt/Carbon)
   * [SQL Formatter](https://github.com/jdorn/sql-formatter)
   * [Guzzle](https://github.com/guzzle/guzzle)
   * [Random String](https://github.com/ircmaxell/RandomLib)

