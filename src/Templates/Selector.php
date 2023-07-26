<?php

namespace Baethon\Graphql\Builder\Templates;

use Baethon\Graphql\Builder\Contracts\Aliasable;
use Baethon\Graphql\Builder\Contracts\Argumentable;
use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\Traits\HasAlias;
use Baethon\Graphql\Builder\Traits\HasArguments;
use Baethon\Graphql\Builder\Traits\HasSelectors;

class Selector implements Aliasable, Selectable, Argumentable
{
    use HasAlias,
        HasArguments,
        HasSelectors;

    public function __construct(private string $field)
    {
    }

    public function __toString()
    {
        $args = isset($this->arguments)
            ? "({$this->arguments})"
            : '';

        $alias = $this->alias
            ? "{$this->alias}: "
            : '';

        return "{$alias}{$this->field}{$args}";
    }
}
