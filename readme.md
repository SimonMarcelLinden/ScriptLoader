# ScriptLoader for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

With this package you can manage header Styles and Scripts Tags to load from Laravel controllers.

----------

## Installation

- [Laravel ScriptLoader on Packagist](https://packagist.org/packages/simonmarcellinden/scriptloader)
- [Laravel ScriptLoader GitHub](https://github.com/SimonMarcelLinden/ScriptLoader)

From the command line run

```
$ composer require simonmarcellinden/scriptloader
```

### Laravel <= 5.4
Once ScriptLoader is installed you need to register the service provider with the application. 
Open up `config/app.php` and find the `providers` key.

Add the service provider to `config/app.php`

```php
    SimonMarcelLinden\ScriptLoader\ScriptLoaderServiceProvider::class,
```
Optionally include the Facade in config/app.php if you'd like.

```php
    "ScriptLoader" =>"SimonMarcelLinden\ScriptLoader\Facades\ScriptLoader::class,
```

### Publish the configurations

~~Run this on the command line from the root of your project:~~

```
$ no config needed
```

~~A configuration file will be publish to `config/scriptloader.php`.~~

## Usage 
### Examples


Add a Script or Style Source directly into your route or controller

#### app/Http/Controllers/Controller.php

```php
<?php 

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use ScriptLoader;

abstract class Controller extends BaseController  {
    use DispatchesCommands, ValidatesRequests;

    public function __construct() {
        // Defaults
        ScriptLoader::set("style", asset('css/default.css'), 3);
        ScriptLoader::set("style", asset('css/app.css'), 1);
    }
}
```

#### app/Http/Controllers/HomeController.php

```php
<?php 

namespace App\Http\Controllers;

use ScriptLoader;

class HomeController extends Controller  {
    public function index() {
        // Section description
        ScriptLoader::set("style", asset('css/home.css'), 2);
        ScriptLoader::set("script", asset('js/home.js'), 4, "defer");

        return view('index');
    }

    public function detail() {
        // Section description
        ScriptLoader::set("style", asset('css/details.css'), 2);
        ScriptLoader::set("script", asset('js/details.js'), 2);

        return view('detail');
    }

    public function privateProfile() {
        ScriptLoader::set("style", asset('css/home.css'), 2);
        ScriptLoader::set("style", asset('css/private.css'), 3);
        ScriptLoader::set("script", asset('js/private.js'), 4, "defer");

        return view('private');
    }
}
```

#### resources/views/layouts/app.blade.php

```php
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Laravel - ScriptLoader</title>

        {!! ScriptLoader::load() !!}
    </head>

    <body>
        @yield('content')
    </body>
</html>
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email info@snerve.de instead of using the issue tracker.

## Credits

- [Simon Marcel Linden][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/simonmarcellinden/scriptloader.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/simonmarcellinden/scriptloader.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/simonmarcellinden/scriptloader/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/simonmarcellinden/scriptloader
[link-downloads]: https://packagist.org/packages/simonmarcellinden/scriptloader
[link-travis]: https://travis-ci.org/simonmarcellinden/scriptloader
[link-author]: https://github.com/simonmarcellinden
[link-contributors]: ../../contributors
