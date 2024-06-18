<p align="center">
<a href="https://github.com/beebmx/blade/actions"><img src="https://img.shields.io/github/actions/workflow/status/beebmx/blade/tests.yml?branch=main" alt="Build Status"></a>
<a href="https://packagist.org/packages/beebmx/blade"><img src="https://img.shields.io/packagist/dt/beebmx/blade" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/beebmx/blade"><img src="https://img.shields.io/packagist/v/beebmx/blade" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/beebmx/blade"><img src="https://img.shields.io/packagist/l/beebmx/blade" alt="License"></a>
</p>

# Blade

The standalone version of [Laravel's Blade templating engine](https://laravel.com/docs/11.x/blade) for use outside of Laravel.

## Installation

Install using composer:

```bash
composer require beebmx/blade
```

## Usage

Create a Blade instance by passing it the folder(s) where your view files are located, and a cache folder. Render a template by calling the `make` method. More information about the Blade templating engine can be found on http://laravel.com/docs/9.x/blade.

```php
use Beebmx\Blade\Blade;

$blade = new Blade('views', 'cache');

echo $blade->make('homepage', ['name' => 'John Doe'])->render();
```

Alternatively you can use the shorthand method `render`:

```php
echo $blade->render('homepage', ['name' => 'John Doe']);
```

You can also extend Blade using the `directive()` function:

```php
$blade->directive('datetime', function ($expression) {
    return "<?php echo with({$expression})->format('F d, Y g:i a'); ?>";
});
```

Which allows you to use the following in your blade template:

```
Current date: @datetime($date)
```

The Blade instances passes all methods to the internal view factory. So methods such as `exists`, `file`, `share`, `composer` and `creator` are available as well. Check out the [original documentation](https://laravel.com/docs/11.x/views) for more information.

## Testing

```bash
composer test
```

## Credits

- Original repository [jenssegers/blade](https://github.com/jenssegers/blade)
- Fernando Gutierrez [@beebmx](https://github.com/beebmx)
- [All Contributors](../../contributors)