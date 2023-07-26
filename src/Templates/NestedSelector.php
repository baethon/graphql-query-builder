<?php

namespace Baethon\Graphql\Builder\Templates;

use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\Traits\HasSelectors;

class NestedSelector implements Selectable
{
    use HasSelectors;

    public function __construct(array $selectors)
    {
        $this->setSelectors($selectors);
    }

    // @TODO render the fields
    public function __toString()
    {
        return "{\n}";
    }
}
