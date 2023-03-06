# Tester

### Instructions on how to use the API.
* Use postman for testing
* tester.test is an example domain, use whatever domain you choose.

* Get all customers records:
`GET --> http://tester.test/api/v1/customers`

* Get a single customer record base on ID
`GET --> http://tester.test/api/v1/customers/find?id=1`

* Create a customer record
`POST --> http://tester.test/api/v1/customers?name=sample`

* Updating a customer record base on id
`PUT --> http://tester.test/api/v1/customers?name=updated_sample&id=9`

* Deleting a customer record base on id
`DELETE --> http://tester.test/api/v1/customers?id=9`


### If you want to install locally:

* Set up database (customers table)
* Set environment variables.
* Copy .env.example on the folder to .env
* Replace the .env variables with your postgres values
* Make sure you have composer and a php that is at least 7.3.

### If you want to run it via Docker

* Run `$ docker-compose up -d`, 
* You need a separate db. 
* You can download my postgres repository on : https://github.com/groovey/docker-common

### Finally Heroku

- https://cartrack-api.herokuapp.com/

Testing out the database connection via env variables
- https://cartrack-api.herokuapp.com/checker.php

Phpinfo version
- https://cartrack-api.herokuapp.com/phpinfo.php

### Heroku API DETAILS:

* Play around with the values like the id and names.

* Get all customers records:
`GET --> https://cartrack-api.herokuapp.com/index.php/api/v1/customers`

* Get a single customer record base on ID
`GET --> https://cartrack-api.herokuapp.com/index.php/api/v1/customers/find?id=002`

* Create a customer record
`POST --> https://cartrack-api.herokuapp.com/index.php/api/v1/customers?name=Harold Kim

* Updating a customer record base on id
`PUT --> https://cartrack-api.herokuapp.com/index.php/api/v1/customers?name=Harold Test&id=239584433`

* Deleting a customer record base on id
`DELETE --> https://cartrack-api.herokuapp.com/index.php/api/v1/customers?id=9`


### What has been done?

* There is no framework that has been used here. Instead I created a simple Crud API framework. 
* The code comes with MVC structure.
* Simple enough to create routes under ./routes/api.php
* Use symfony components via composer and other packagist
* Coding standard to PSR
* Ready for ESlint for javascript, using (https://standardjs.com/)
* Added autoloading and namespacing
* Code has been run on `$ php-cs-fixer`

### Questions and clarification?

Feel free to contact me on my github. 