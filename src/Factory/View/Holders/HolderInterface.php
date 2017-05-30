<?php

/*
 * This file is part of the Laravel Helpers package.
 *
 * (c) Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Factory\View\Holders;

/**
 * Interface HolderInterface
 *
 * @author Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
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