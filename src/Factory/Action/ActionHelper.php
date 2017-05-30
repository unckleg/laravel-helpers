<?php

/*
 * This file is part of the Laravel Helpers package.
 *
 * (c) Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Factory\Action;

use Illuminate\Http\Request;
use Unckleg\Helpers\Factory\Action\Interfaces\RequestAwareInterface;

/**
 * Class ActionHelper
 *
 * @author Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
class ActionHelper implements RequestAwareInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * ActionHelperBroker constructor.
     */
    public function __construct()
    {
        $this->setRequest(request());
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(Request $request = null)
    {
        if ($this->request == null) {
            $this->request = $request;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getRequest()
    {
        if ($this->request !== null) {
            return $this->request;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setParameter($name, $value)
    {
        $request = $this->request;
        $request->request->add([$name, $value]);
    }

    /**
     * {@inheritDoc}
     */
    public function getParameter($name)
    {
        $name = (string) $name;
        if ($this->hasParameter($name)) {
            return $this->request->$name;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function hasParameter($name)
    {
        return $this->request->$name !== null ?
            true : false;
    }
}