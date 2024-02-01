<?php

namespace App\Constants;

use ReflectionClass;

/**
 * ConstantInterface.php
 */
class AbstractConstant
{
    /**
     * @return array
     */
    public static function all(): array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

}