<?php

/*
 * This file is part of the Laravel Helpers package.
 *
 * (c) Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Factory\Action\Interfaces;

use Illuminate\Http\Request;

/**
 * RequestAwareInterface should be implemented by classes that depends on a Request.
 */
interface RequestAwareInterface
{
    /**
     * Sets the request.
     *
     * @param Request|null $request A Request instance or null
     */
    public function setRequest(Request $request = null);

    /**
     * Gets the current request object.
     *
     * @return mixed
     */
    public function getRequest();

    /**
     * Gets parameter from request.
     *
     * @param  string $name
     * @return mixed
     */
    public function getParameter($name);

    /**
     * Sets new request parameter.
     *
     * @param  string $name
     * @param  $value
     * @return mixed
     */
    public function setParameter($name, $value);

    /**
     * Checks for existence of request parameter.
     *
     * @param  string $name
     * @return boolean
     */
    public function hasParameter($name);
}