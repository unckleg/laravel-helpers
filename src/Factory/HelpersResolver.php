<?php

/**
 * This file is part of the Laravel Helpers package.
 *
 * @license MIT License https://mit-license.org
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
namespace Unckleg\Helpers\Factory;

use Unckleg\Helpers\Factory\Action\ActionResolver;
use Unckleg\Helpers\Factory\View\ViewResolver;

class HelpersResolver
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