<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1cd82b074a0e27f5b7e43f5caada4677
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/php-sdk-v4/src/Facebook',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1cd82b074a0e27f5b7e43f5caada4677::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1cd82b074a0e27f5b7e43f5caada4677::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
