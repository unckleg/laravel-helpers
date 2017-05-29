<?php

/**
 * This file is part of the Laravel Helpers package.
 *
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * @license MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Factory;

use Unckleg\Helpers\Factory\Action\ActionResolver;
use Unckleg\Helpers\Factory\View\ViewResolver;

class Factory
{
    /**
     * To resolve or not to resolve
     *
     * @return void
     */
    public static function resolve()
    {
        $config = config('helpers')['resolve'];

        if ($config['view'] === true) {
            ViewResolver::resolve();
        }

        if ($config['action'] === true) {
            ActionResolver::resolve();
        }
    }
}