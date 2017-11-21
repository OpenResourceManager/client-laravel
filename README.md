# ORM Client - Laravel

ORM client library with enhancements for Laravel

---

* ORM settings are read from `.env`.
* ORM sessions are cached.
* Efficiently handles authentication. 


### Installation:

##### Add to `composer.json`:

```shell
composer require open-resource-manager/client-laravel ~0.1
```

##### Add to `config/app.php`:

Note, you only need to do this on Laravel < 5.5, since Laravel 5.5 has auto discover.

* Add to `providers` array under `Package Service Providers`: `OpenResourceManager\Laravel\ORMServiceProvider::class`
* Add to end of `aliases` array: `'ORM' => OpenResourceManager\Laravel\Facade\ORM::class,`
 
##### Publish config:

```shell
php artisan vendor:publish --tag orm
```

##### Edit Env (`.env`)

Add the following to your `.env` with values that pertain to you

```
ORM_SECRET=klfnqjafjk890fhd89qmq39dfj90
ORM_HOST=orm.example.com
ORM_PORT=443
ORM_SSL=true
ORM_SESSION_TTL=59
```

### Usage:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ORM;
use OpenResourceManager\Client\Account as AccountClient;

class ExampleController extends Controller
{
    public function index()
    {
        $orm = ORM::get();
        $accountClient = new AccountClient($orm);
        return $accountClient->getList()->raw_body;
    }
}
```
