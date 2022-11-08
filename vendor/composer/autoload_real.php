<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit51a0ae41f8f9b6ccf9bbd4697412e6d6
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit51a0ae41f8f9b6ccf9bbd4697412e6d6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit51a0ae41f8f9b6ccf9bbd4697412e6d6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit51a0ae41f8f9b6ccf9bbd4697412e6d6::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}