<?php

/*
 * This file is part of the Laravel Helpers package.
 *
 * (c) Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Factory\Action;


/**
 * Class ActionHelperBroker
 *
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
class ActionHelperBroker
{

    /**
     * @param  string $expression | Name of Action Helper class separated with scope operator
     * @return mixed
     */
    public static function getHelper($expression)
    {
        $self = new self();
        $namespace = $self->getNamespaceByDirectory();

        $helperClass = $namespace . $expression;
        if (strpos($expression, ':') !== false) {
            $helperClass = $namespace . str_replace(':', '\\', $expression);
        }

        if (class_exists($helperClass)) {
            return new $helperClass;
        }
    }

    /**
     * Method getHelpersDirectory returns defined helpers directory in config.
     * @return string
     */
    protected function getHelpersDirectory()
    {
        $dirs = config('helpers.directories');
        return app_path() .'/'. $dirs['root'] .'/'. $dirs['action'];
    }

    /**
     * Method getNamespaceByDirectory returns namespace from defined helpers directory names.
     * @return string
     */
    protected function getNamespaceByDirectory()
    {
        $dirs = config('helpers.directories');
        return 'App\\' . ucfirst($dirs['root']) .'\\'. ucfirst($dirs['action']) .'\\';
    }
}