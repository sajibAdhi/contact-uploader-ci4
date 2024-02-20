<?php

namespace App\Traits;

use ReflectionClass;

trait CountableConstants
{
    public static function all(): array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

    public static function count(): int
    {
        return count(static::all());
    }
}