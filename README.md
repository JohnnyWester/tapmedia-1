Test case for back-end developer | Tapmedia
============================

CONFIGURATION
-------------

### Composer

Run this command in your terminal:

```
$ composer install --prefer-dist
```

### Database

You can copy the file `config/db_example.php` into `config/db.php`.
Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.

### Run application

You can select two different ways to run the application:

1. Run the next command from the project root:

```
$ php yii serve
```

and after that go to 
~~~
http://localhost:8080
~~~

2. Configure your local server (Nginx or Apache).
For example: copy `vhost_example.conf` file to `vhost.conf` from the project root and configure it for your system
to run the application with Nginx.