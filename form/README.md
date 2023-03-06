# Form

Groovey Form Package

## Installation

    $ composer require groovey/form

## Usage

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Silex\Application;
use Groovey\Form\Providers\FormServiceProvider;

$app = new Application();
$app['debug'] = true;

$app->register(new FormServiceProvider());

$app['form']->text('test', 'Hello World');
```

## Form Elements

- [Text](#text)
- [Password](#password)
- [Email](#email)
- [File](#file)
- [Checkbox](#checkbox)
- [Radio](#radio)
- [Select](#select)
- [Select Range](#select_range)
- [Select Month](#select_month)
- [Submit](#submit)
- [Token](#token)
- [Label](#label)
- [Form Open](#form_open)
- [Form Close](#form_close)

## Text

    $app['form']->text('test', 'hello');</td>

## Password

    $app['form']->password('password'); ?></td>

## Email

    $app['form']->email('$name');

## File

    $app['form']->file('test');

## Checkbox

    $app['form']->checkbox('name', 'value');
    $app['form']->checkbox('name', 'value', true);

## Radio

    $app['form']->radio('name', 'value');
    $app['form']->radio('name', 'value', true);

## Select

    $app['form']->select('size', array('L' => 'Large', 'S' => 'Small'));
    $app['form']->select('size', array('L' => 'Large', 'S' => 'Small'), 'S');
    $app['form']->select('animal', array(
                'Cats' => array('leopard' => 'Leopard'),
                'Dogs' => array('spaniel' => 'Spaniel'),
            ));

<div id='select_range'></div>
## Select Range

    $app['form']->selectRange('number', 10, 20);

<div id='select_month'></div>
## Select Month

    $app['form']->selectMonth('month');

## Submit

    $app['form']->submit('Click Me!');

## Token

    $app['form']->token();

## Label

    $app['form']->label('email', 'E-Mail Address');
    $app['form']->label('email', 'e-Mail Address', ['class' => 'awesome']);

<div id='form_open'></div>
## Form Open

    $app['form']->open(['url' => 'foo/bar']);
    $app['form']->open(['url' => 'foo/bar', 'method' => 'put']);

<div id='form_close'></div>
## Form Close

    $app['form']->close();
