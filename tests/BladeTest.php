<?php

use Beebmx\Blade\Blade;
use Beebmx\Blade\Container;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Illuminate\View\ViewFinderInterface;

beforeEach(function () {
    $this->blade = new Blade('tests/fixtures/views', 'tests/fixtures/cache', new Container);

    $this->blade->directive('datetime', function ($expression) {
        return "<?php echo with({$expression})->format('F d, Y g:i a'); ?>";
    });

    $this->blade->if('ifdate', function ($date) {
        return $date instanceof DateTime;
    });
});

test('compiler getter', function () {
    expect($this->blade->compiler())
        ->toBeInstanceOf(BladeCompiler::class);
});

test('basic rendering', function () {
    expect(trim($this->blade->make('basic')))
        ->toEqual('hello world');
});

test('exists', function () {
    expect($this->blade->exists('nonexistentview'))
        ->toBeFalse();
});

test('variables', function () {
    expect(trim($this->blade->make('variables', ['name' => 'John Doe'])))
        ->toEqual('hello John Doe');
});

test('non blade', function () {
    expect(trim($this->blade->make('plain')))
        ->toEqual('{{ this is plain php }}');
});

test('file', function () {
    expect(trim($this->blade->file('tests/fixtures/views/basic.blade.php')))
        ->toEqual('hello world');
});

test('share', function () {
    $this->blade->share('name', 'John Doe');

    expect(trim($this->blade->make('variables')))
        ->toEqual('hello John Doe');
});

test('composer', function () {
    $this->blade->composer('variables', function (View $view) {
        $view->with('name', 'John Doe and '.$view->offsetGet('name'));
    });

    expect(trim($this->blade->make('variables', ['name' => 'Jane Doe'])))
        ->toEqual('hello John Doe and Jane Doe');
});

test('creator', function () {
    $this->blade->creator('variables', function (View $view) {
        $view->with('name', 'John Doe');
    });

    $this->blade->composer('variables', function (View $view) {
        $view->with('name', 'Jane Doe and '.$view->offsetGet('name'));
    });

    expect(trim($this->blade->make('variables')))
        ->toEqual('hello Jane Doe and John Doe');
});

test('render alias', function () {
    expect(trim($this->blade->render('basic')))
        ->toEqual('hello world');
});

test('directive', function () {
    expect(trim($this->blade->make('directive', ['birthday' => new DateTime('1980/01/01')])))
        ->toEqual('Your birthday is January 01, 1980 12:00 am');
});

test('if', function () {
    expect(trim($this->blade->make('if', ['birthday' => new DateTime('1989/08/19')])))
        ->toEqual('Birthday August 19, 1989 12:00 am detected');
});

test('add namespace', function () {
    $this->blade->addNamespace('other', 'tests/fixtures/views/other');

    expect(trim($this->blade->make('other::basic')))
        ->toEqual('hello other world');
});

test('replace namespace', function () {
    $this->blade->addNamespace('other', 'tests/fixtures/views/other');
    $this->blade->replaceNamespace('other', 'tests/fixtures/views/another');

    expect(trim($this->blade->make('other::basic')))
        ->toEqual('hello another world');
});

test('view getter', function () {
    /** @var Factory $view */
    $view = $this->blade;

    expect($view->getFinder())
        ->toBeInstanceOf(ViewFinderInterface::class);
});

test('other', function () {
    $users = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@doe.com',
        ],
        [
            'id' => 2,
            'name' => 'Jen Doe',
            'email' => 'jen.doe@example.com',
        ],
        [
            'id' => 3,
            'name' => 'Jerry Doe',
            'email' => 'jerry.doe@doe.com',
        ],
    ];

    $output = $this->blade->make('other', [
        'users' => $users,
        'name' => '<strong>John</strong>',
        'authenticated' => false,
    ]);

    expect((string) $output)
        ->toEqual(expected('other'));
});

test('extends', function () {
    expect($this->blade->make('extends'))
        ->toEqual(expected('extends'));
});

test('basic without set application', function () {
    $blade = new Blade('tests/fixtures/views', 'tests/fixtures/cache');
    expect(trim($blade->make('basic')))
        ->toEqual('hello world');
});
