<?php

namespace Baethon\Graphql\Builder\Traits;

trait HasAlias
{
    private ?string $alias = null;

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }
}
