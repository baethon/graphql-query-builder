<?php

namespace Baethon\Graphql\Builder\Contracts;

interface Selectable
{
    public function setSelectors(array $selectors): void;
}
