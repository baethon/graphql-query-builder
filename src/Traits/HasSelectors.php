<?php

namespace Baethon\Graphql\Builder\Traits;

trait HasSelectors
{
    private array $selectors = [];

    public function setSelectors(array $selectors): void
    {
        $this->selectors = $selectors;
    }
}
