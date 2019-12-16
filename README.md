# Socialite for Qiita

https://qiita.com/api/v2/docs

## Requirements
- PHP >= 7.2

## Installation
```
composer require revolution/socialite-qiita
```

### config/services.php

```
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
```
Route::get('login', 'SocialiteController@login');
Route::get('callback', 'SocialiteController@callback');
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
                        ->setScopes(['read_qiita', 'write_qiita'])
                        ->redirect();
    }
```

## Demo
https://github.com/kawax/socialite-project

## LICENCE
MIT
Copyright kawax
