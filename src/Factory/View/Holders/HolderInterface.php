<?php

/**
 * This file is part of the Laravel Helpers package.
 *
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * @license MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Factory\View\Holders;


interface HolderInterface
{

    /**
     * Method defineStackHolder used to build Blade Stack holder for injecting Assets.
     *
     * @param  string  - name of stack holder
     * @return mixed
     */
    public function defineStackHolder($name);

}