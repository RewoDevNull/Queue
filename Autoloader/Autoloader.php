<?php

namespace Queue\Autoloader;

/**
 * Class Autoloader
 * Our main class loader. Loads all Toolbox related classes and some vendor libs.
 *
 * @package   Queue
 * @author    Johann Tierbach
 */
class Autoloader
{
    const STRATEGY_QUEUE = 0;

    const NAMESPACE_DELIMITER = '\\';
    const FILE_EXTENSION      = '.php';

    const PREFIX_QUEUE    = '/';
    const AUTOLOADER_PATH = '/Queue/Autoloader';

    /**
     * Returns a anonymous function
     *
     * @return \Closure
     */
    public static function getAutoloaderCallable()
    {
        /**
         * Loads the class/interface file if possible.
         *
         * @param $class
         */
        return function ($class) {
            $currentPath = __DIR__;
            $prefix      = self::PREFIX_QUEUE;

            $rootPath  = str_replace(self::AUTOLOADER_PATH, '', $currentPath);
            $classPath = str_replace(self::NAMESPACE_DELIMITER, '/', $class);

            $filePath = $rootPath . $prefix . $classPath . self::FILE_EXTENSION;

            if (file_exists($filePath)) {
                require_once $filePath;
            }
        };
    }
}

