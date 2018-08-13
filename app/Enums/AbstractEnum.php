<?php

namespace App\Enums;

/**
 *
 */
abstract class AbstractEnum
{
    /**
     * @return string[]
     */
    public static function getAll()
    {
        $reflector = new \ReflectionClass(get_called_class());

        return $reflector->getConstants();
    }
}
