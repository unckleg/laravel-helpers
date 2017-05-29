<?php

/**
 * This file is part of the Laravel Helpers package.
 *
 * @license MIT License https://mit-license.org
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
namespace Unckleg\Helpers\Factory\View\Collection;

use Illuminate\Support\Facades\Blade;

class Broker
{
    /**
     * Property brokerMethodName used for directive name;
     *
     * @var string
     */
    protected $brokerMethodName = 'getViewHelper';

    /**
     * Method getViewHelper used to access specific class methods.
     *
     * It is useful when there are two or more methods with same names.
     * By default HelperResolver 'll load all methods from every Helper class
     * and assign it as view/action helper, so if resolver encounters some method
     * that is already been registered within app lifecycle it will override it with new one.
     *
     * @param  $expression
     * @return string
     */
    public function getViewHelper($expression)
    {

    }

    /**
     * Method registerBrokerDirective used to register getViewHelper method as blade directive
     * regardless to the helpers config.
     *
     * getViewHelper is also directive but it is not listed in helpers config because
     * we don't want to let the end user to delete it from config or override it.
     *
     */
    public function registerBrokerDirective()
    {
        $selfClassName = self::class;
        // Register blade directive through whole application lifecycle
        Blade::directive($this->brokerMethodName, function($expression)
            use($selfClassName)
        {

            $expression = (string) $expression;
            //TODO: Throw exceptions and errors if something is invalid
            $configDirectories    = config('helpers')['directories'];
            $viewHelpersDirectory = app_path() . '/' . $configDirectories['root'] . '/' . $configDirectories['view'];

            preg_match('/^.*(?=->)/',      $expression,         $class);
            preg_match('/([^->]*)$/',      $expression,         $methodWithArgs);
            preg_match('/(.*?)(?=\(|$)/',  $methodWithArgs[0],  $cleanMethodName);

            $className       = ucfirst($class[0]);
            $helperFile      = $viewHelpersDirectory .'/'. $className . '.php';
            $cleanMethodName = $cleanMethodName[0];
            $methodWithArgs  = $methodWithArgs[0];

            if (file_exists($helperFile)) {
                $helperClass = 'App\\'.$configDirectories['root'].'\\'.$configDirectories['view'].'\\'.$className;
                if (class_exists($helperClass)) {
                    if (method_exists((new $helperClass), $cleanMethodName)) {
                        dd('adwwad');
                        return '<?php (new $helperClass())->{$methodWithArgs}; ?>';
                    }
                }
            }

        });
    }
}