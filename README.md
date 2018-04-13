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
```

### Usage:

#### Using Helper Function:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenResourceManager\Client\Account as AccountClient;

class ExampleController extends Controller
{
    public function index()
    {
        $orm = getORMConnection();
        $accountClient = new AccountClient($orm);
        return $accountClient->getList()->raw_body;
    }
}
```

#### Using Facade:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenResourceManager\Laravel\Facade\ORM;
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

#### ORM Account Trait:

Ensure that your user model has an `orm_id` attribute and it is set to the ORM ID of the account.

##### Available Trait Methods:

* `$user->account()` - Returns the entire ORM Account for that User.
* `$user->emails()` - Returns the user's ORM Emails.
* `$user->mobilePhones()` - Returns the user's ORM Mobile Phones.
* `$user->addresses()` - Returns the user's ORM Addresses.
* `$user->duties()` - Returns the user's ORM Duties.

##### Available Trait Attributes:
* `$user->account` - Returns the entire ORM Account for that User.

##### Setup and Examples

Sample Users Migration:

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orm_id')->unique(); // Add this to your user's model and fill it with the related ORM Account ID.
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
```

Sample User Model:

```php
<?php

namespace App\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OpenResourceManager\Laravel\Traits\OrmAccount; // Add the OrmAccount trait

class User extends Authenticatable
{
    use HasApiTokens, Notifiable; 
    use OrmAccount; // Add the OrmAccount trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orm_id',
        'username',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
```

Example Usage:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class MyController extends Controller
{
    
    /**
    * Trait methods:
    * 
    * $user->account();
    * $user->emails();
    * $user->mobilePhones();
    * $user->addresses();
    * $user->duties(); 
    */
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
    * Shows a user's ORM Account
    */
    public function showUserAccount($id) 
    {
        $user = User::findOrFail($id);
        
        return $user->account(); // Returns the ORM account
    }
    
    /**
    * Shows a user's ORM Emails
    */
    public function showUserEmails($id) 
    {
        $user = User::findOrFail($id);
        
        return $user->emails(); // Returns the ORM emails
    }
}
```
