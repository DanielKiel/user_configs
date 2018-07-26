# decrypted configs dependent to an user

You can save user dependent config params. The params will be decrypted before storing them at the database and encrypted on getting the config object.

# installation /setup

```
composer require dionyseos/user_configs

php artisan vendor:publish 
```

when publishing the vendor, choose Dion\UserConfig.

# using the config

At \App\User, register the trait (preferred) \Dion\UserConfig\HasUserConfigs

## storing the configs

Creating a config:

```php
auth()
    ->user()
    ->_config()
    ->create([
        'data' => [
            'apiKey' => 'some key',
            //...
        ]
    ]);
```

Updating a config:

```php
auth()
    ->user()
    ->_config
    ->update([
        'data' => [
            'apiKey' => 'some key now changed',
            //...
        ]
    ]);
```

## getting the config

```php
user_config('apiKey', 'defau;tValueWhenNotFound');
```



