<?php

namespace SimonMarcelLinden\ScriptLoader\Facades;

use Illuminate\Support\Facades\Facade;

class ScriptLoader extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string {
        return 'scriptloader';
    }
}
