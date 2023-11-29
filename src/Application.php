<?php

namespace Beebmx\Blade;

use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application as ApplicationInterface;
use Illuminate\Support\Traits\Macroable;

class Application extends Container implements ApplicationInterface
{
    use Macroable;

    const VERSION = '1.7.1';

    public function version(): string
    {
        return static::VERSION;
    }

    /**
     * The array of terminating callbacks.
     *
     * @var callable[]
     */
    protected array $terminatingCallbacks = [];

    /**
     * Register a terminating callback with the application.
     *
     * @param  callable|string  $callback
     * @return $this
     */
    public function terminating($callback): static
    {
        $this->terminatingCallbacks[] = $callback;

        return $this;
    }

    /**
     * Terminate the application.
     */
    public function terminate(): void
    {
        $index = 0;

        while ($index < count($this->terminatingCallbacks)) {
            $this->call($this->terminatingCallbacks[$index]);

            $index++;
        }
    }

    public function basePath($path = '')
    {
    }

    public function bootstrapPath($path = '')
    {
    }

    public function configPath($path = '')
    {
    }

    public function databasePath($path = '')
    {
    }

    public function resourcePath($path = '')
    {
    }

    public function storagePath($path = '')
    {
    }

    public function environment(...$environments)
    {
    }

    public function runningInConsole()
    {
    }

    public function runningUnitTests()
    {
    }

    public function maintenanceMode()
    {
    }

    public function isDownForMaintenance()
    {
    }

    public function registerConfiguredProviders()
    {
    }

    public function register($provider, $force = false)
    {
    }

    public function registerDeferredProvider($provider, $service = null)
    {
    }

    public function resolveProvider($provider)
    {
    }

    public function boot()
    {
    }

    public function booting($callback)
    {
    }

    public function booted($callback)
    {
    }

    public function bootstrapWith(array $bootstrappers)
    {
    }

    public function getLocale()
    {
    }

    public function getNamespace()
    {
    }

    public function getProviders($provider)
    {
    }

    public function hasBeenBootstrapped()
    {
    }

    public function loadDeferredProviders()
    {
    }

    public function setLocale($locale)
    {
    }

    public function shouldSkipMiddleware()
    {
    }

    public function langPath($path = '')
    {
    }

    public function publicPath($path = '')
    {
    }

    public function hasDebugModeEnabled()
    {
    }
}
