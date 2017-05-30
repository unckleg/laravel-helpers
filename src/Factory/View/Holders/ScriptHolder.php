<?php

/*
 * This file is part of the Laravel Helpers package.
 *
 * (c) Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Factory\View\Holders;

use Illuminate\View\Compilers\Concerns\CompilesStacks;

/**
 * Class ScriptHolder
 *
 * @author Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
class ScriptHolder implements HolderInterface
{
    use CompilesStacks;

    /**
     * Default Script stackHolder Name where the all scripts would be injected from buffered holders.
     *
     * @var string
     */
    protected $stackHolder  = null;

    /**
     * Default script html element defined as holder for libraries/attributes injecting.
     *
     * @var string
     */
    protected $scriptHolder = '<script src="{{ asset(@path) }}"></script>';

    /**
     * Default inline script html element sames as for scriptHolder.
     *
     * @var string
     */
    protected $inlineHolder = '<script type="text/javascript">@expression</script>';

    /**
     * Data returned from output_buffer - compilePush() method.
     *
     * @var array
     */
    protected $stackHolderContent = [];

    /**
     * Defines stackHolder where to inject content from output buffer.
     *
     * @param  string $name
     * @return string
     */
    public function defineStackHolder($name)
    {
        if (empty($this->stackHolder)) {
            $this->stackHolder = "('{$name}')";
        }
    }
}