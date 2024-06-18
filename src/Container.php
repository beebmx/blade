<?php

namespace Beebmx\Blade;

use Closure;
use Illuminate\Container\Container as BaseContainer;
use Illuminate\Support\Traits\Macroable;

class Container extends BaseContainer
{
    use Macroable;

    /**
     * The array of terminating callbacks.
     *
     * @var callable[]
     */
    protected array $terminatingCallbacks = [];

    /**
     * Register a terminating callback with the application.
     */
    public function terminating(Closure $callback): static
    {
        $this->terminatingCallbacks[] = $callback;

        return $this;
    }

    /**
     * Terminate the application.
     */
    public function terminate(): void
    {
        foreach ($this->terminatingCallbacks as $terminatingCallback) {
            $terminatingCallback();
        }
    }
}
