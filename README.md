# Socialite for Qiita

https://qiita.com/api/v2/docs

## Requirements
- PHP >= 8.0

> No version restrictions. It may stop working in future versions.

## Installation
```
composer require revolution/socialite-qiita
```

### config/services.php

```php
    'qiita' => [
        'client_id'     => env('QIITA_CLIENT_ID'),
        'client_secret' => env('QIITA_CLIENT_SECRET'),
        'redirect'      => env('QIITA_REDIRECT'),
    ],
```

### .env
```
QIITA_CLIENT_ID=
QIITA_CLIENT_SECRET=
QIITA_REDIRECT=
```

## Usage

routes/web.php
```php
Route::get('login', [SocialiteController::class, 'login']);
Route::get('callback', [SocialiteController::class, 'callback']);
```

SocialiteController

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialiteController extends Controller
{
    public function login()
    {
        return Socialite::driver('qiita')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('qiita')->user();
        dd($user);
    }
}

```

## Scopes

https://qiita.com/api/v2/docs#%E3%82%B9%E3%82%B3%E3%83%BC%E3%83%97

```php
    public function login()
    {
        return Socialite::driver('qiita')
                        ->scopes(['read_qiita_team', 'write_qiita_team'])
                        ->redirect();
    }
```

## Demo
https://github.com/kawax/socialite-project

## LICENCE
MIT
Copyright kawax
