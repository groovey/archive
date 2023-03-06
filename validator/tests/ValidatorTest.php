<?php

use Silex\Application;
use Groovey\Validator\Providers\ValidatorServiceProvider;
use Illuminate\Validation\Validator;

class ValitorTest extends PHPUnit_Framework_TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new ValidatorServiceProvider());

        $this->app = $app;
    }

    public function testFails()
    {
        $app = $this->app;

        $validator = $app['validator']->make([
                'name'  => '',
                'email' => 'not an email',
            ], [
                'name'  => 'required',
                'email' => 'required|email',
            ]);

        $status = $validator->fails();
        $this->assertTrue($status);
    }

    public function testPass()
    {
        $app = $this->app;

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
            $this->assertTrue($status);
        } else {
            $errors = $validator->errors();
            print_r($errors);
        }
    }

    public function testMessage()
    {
        $app       = $this->app;
        $input     = ['name' => ''];
        $rules     = ['name' => 'required|alpha|min:5'];
        $messages  = ['name.required' => 'Whoops the :attribute field is required'];
        $validator = $app['validator']->make($input, $rules, $messages);

        $status = $validator->passes();

        if ($status) {
        } else {
            $errors = $validator->errors()->all();
            $this->assertRegExp('/Whoops/', $errors[0]);
        }
    }

    public function testCustom()
    {
        $app     = $this->app;
        $valid   = $app['validator.helper']->image('test.jpg');
        $invalid = $app['validator.helper']->image('test');

        $this->assertTrue($valid);
        $this->assertFalse($invalid);
    }
}
