<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit21935f682a8b30265a9c92f16a873f30
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'config\\' => 7,
        ),
        'V' => 
        array (
            'Views\\' => 6,
        ),
        'S' => 
        array (
            'Services\\' => 9,
        ),
        'R' => 
        array (
            'Repositories\\' => 13,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'L' => 
        array (
            'Lib\\' => 4,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'Views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Views',
        ),
        'Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Services',
        ),
        'Repositories\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Repositories',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Lib',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Zebra_Pagination' => __DIR__ . '/..' . '/stefangabos/zebra_pagination/Zebra_Pagination.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit21935f682a8b30265a9c92f16a873f30::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit21935f682a8b30265a9c92f16a873f30::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit21935f682a8b30265a9c92f16a873f30::$classMap;

        }, null, ClassLoader::class);
    }
}
