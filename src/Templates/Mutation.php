<?php

namespace Baethon\Graphql\Builder\Templates;

use Baethon\Graphql\Builder\Contracts\Argumentable;
use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\Traits\HasArguments;
use Baethon\Graphql\Builder\Traits\HasSelectors;

class Mutation implements Argumentable, Selectable
{
    use HasArguments,
        HasSelectors;

    public function __toString()
    {
        $args = isset($this->arguments)
            ? "({$this->arguments})"
            : '';

        $selectors = empty($this->selectors)
            ? " {\n}"
            : ' '.(new NestedSelector($this->selectors));

        return "mutation{$args}{$selectors}";
    }
}
