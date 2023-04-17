<?php

namespace App\Enums;

use Exception;
use ReflectionClass;

abstract class RolesEnum{
    CONST ADMINISTRATOR = 'Administrador';
    CONST SUPER_ADMIN = 'Super Admin';
    CONST LANDLORD = 'Arrendador';
    CONST TENANT = 'Arrendatario';

    /**
     * Returns the constants of this class (All the roles available)
     */
    public static function getRoles()
    {
        $reflectionClass = new ReflectionClass(static::class);
        return $reflectionClass->getConstants();
    }


}