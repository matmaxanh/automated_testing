[![Build Status](https://travis-ci.org/truongnguyen1912/automated_testing.svg?branch=master)](https://travis-ci.org/truongnguyen1912/automated_testing)

# PHP Automated testing

## General
This project is used as a sample on how to write tests using Codeception library for a Laravel application.

Three test suites are included: Unit / Integration / Functional

## Installation
Docker should be installed.
For more information: [click here](http://docker.com)

* `docker-compose up`
* `winpty docker exec -ti php bash`
* `php artisan migrate:refresh --seed`

Update your host file and create an entry:
`127.0.0.1    automated_testing.dev`

You can now access the app by visiting: [http://automated_testing.dev](http://automated_testing.dev)

## Run tests
Create test DB:
```
winpty docker exec -ti mysql bash
mysql -uroot -proot -e 'CREATE DATABASE laravel_test;'
```
Test command:
```
winpty docker exec -ti php bash
```

```
vendor/bin/codecept run
```
Test with coverage:
```
vendor/bin/codecept run --coverage --coverage-html
```
## Reference
* [http://codeception.com](http://codeception.com)
* [Another sample project](https://github.com/janhenkgerritsen/codeception-laravel5-sample)
