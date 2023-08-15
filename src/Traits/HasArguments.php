<?php

namespace Baethon\Graphql\Builder\Traits;

use Baethon\Graphql\Builder\Templates\Arguments;

trait HasArguments
{
    private Arguments $arguments;

    public function setArguments(array|Arguments $arguments): void
    {
        $this->arguments = Arguments::wrap($arguments);
    }
}
