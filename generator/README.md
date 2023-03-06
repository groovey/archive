# Generator

Groovey Generator Package

## Installation

    $ composer require groovey/generator

## Usage

    $ groovey generator:create Controller User

## Setup

On your project root folder, create a file `groovey`.

```php
#!/usr/bin/env php
<?php

set_time_limit(0);

use Silex\Application;
use Groovey\Console\Providers\ConsoleServiceProvider;

include __DIR__.'/vendor/autoload.php';

$app = new Application();

$app->register(new ConsoleServiceProvider(), [
        'console.name'    => 'Groovey',
        'console.version' => '1.0.0',
    ]);

$console = $app['console'];

$console->addCommands([
        new Groovey\Generator\Commands\About(),
        new Groovey\Generator\Commands\Create(),
    ]);

$status = $console->run();

exit($status);
```

## Config File

Create a file in ./config/generator.php

```php
<?php

return [
    'Controller' => [
        'source' => 'controller.php',
        'destination' => './output/ARG1.php',
        'replace' => [
            'class'    => 'ARG1|ucfirst',
            'comments' => 'Code goes here.',
        ],
    ],
];

```

`Controller` is the key argument.

`Source` is your template.

`Destination` is your destination file output.

`Replace` is where you replace the templates with your contents.

Argument constants such as `ARG1`, `ARG2`, etc will be replace depending on your arguments.

## Templates

Create the template file as defined on your `generator.php` file.

Anything that are enclosed by `{{variable}}` will be replaced.

Template location will be in (./resources/generators)

```php
<?php

class {{class}} extends Controller
{

    function __construct()
    {
        // {{comments}}
    }

}
```
## Run

    $ groovey generate:create Controller Sample


## Notes

    $ groovey generate:create Controller User

* `ARG0` - The 0 argument. Value is `Controller`.
* `ARG1` - The 1st argument. Value is `User`.
* `ARG2` - The 2nd argument. Value is `Empty`.
* `ARGN` - The N'th argument.