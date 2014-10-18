cakephp-redis
=============

Redis DataSource Plugin for CakePHP

## Requirements
- PHP5
- CakePHP2
- [pecl redis](http://pecl.php.net/package/redis)


## Installation

```sh
cd app/Plugin
git clone git@github.com:nanapi/cakephp-redis.git Redis
```

app/Config/bootstrap.php
```
CakePlugin::load('Redis');
```

app/Config/database.php
```php
<?php

class DATABASE_CONFIG {

  public $redis = array(
    'datasource' => 'Redis.RedisSource',
    'host' => 'localhost',
    'port' => '6379',
    'db' => '0'
  );

```


## How to use it

your model
```php
<?php

App::uses('RedisModel', 'Redis.Model');
class MyRedis extends RedisModel {
}

```

your controller
```php
<?php
App::uses('AppController', 'Controller');
class MyController extends AppController {
  public $uses = array(
    'MyRedis';
  );

  public function index() {
    $this->MyRedis->set('key', 'value');
    $this->MyRedis->get('key');

    $this->MyRedis->incr('pv');
  }
}

```


## Methods
This is a wrapper for [phpredis][]. For a list of methods that can be used by the Model, please refer to the README for phpredis.


[phpredis]: https://github.com/nicolasff/phpredis "phpredis"
