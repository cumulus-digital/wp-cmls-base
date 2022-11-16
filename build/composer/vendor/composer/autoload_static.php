<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf36efb58eb2999abb351b58024bf356c
{
    public static $files = array (
        'a5f882d89ab791a139cd2d37e50cdd80' => __DIR__ . '/..' . '/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CMLS_Base\\Vendors\\vena\\AcfJson\\' => 31,
            'CMLS_Base\\Vendors\\WPTRT\\Customize\\Control\\' => 42,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CMLS_Base\\Vendors\\vena\\AcfJson\\' => 
        array (
            0 => __DIR__ . '/..' . '/vena/acf-json/src',
        ),
        'CMLS_Base\\Vendors\\WPTRT\\Customize\\Control\\' => 
        array (
            0 => __DIR__ . '/..' . '/wptrt/control-color-alpha/src',
        ),
    );

    public static $classMap = array (
        'CMLS_Base\\Vendors\\WPTRT\\Customize\\Control\\ColorAlpha' => __DIR__ . '/..' . '/wptrt/control-color-alpha/src/ColorAlpha.php',
        'CMLS_Base\\Vendors\\vena\\AcfJson\\Loader' => __DIR__ . '/..' . '/vena/acf-json/src/Loader.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf36efb58eb2999abb351b58024bf356c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf36efb58eb2999abb351b58024bf356c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf36efb58eb2999abb351b58024bf356c::$classMap;

        }, null, ClassLoader::class);
    }
}
