<?php

namespace Baethon\Graphql\Builder\Templates;

use Baethon\Graphql\Builder\Contracts\Aliasable;
use Baethon\Graphql\Builder\Contracts\Argumentable;
use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\Traits\HasAlias;
use Baethon\Graphql\Builder\Traits\HasArguments;
use Baethon\Graphql\Builder\Traits\HasSelectors;

class EmptySelector implements Aliasable, Selectable, Argumentable
{
    use HasAlias,
        HasSelectors,
        HasArguments;

    public function __toString()
    {
        return '';
    }
}
