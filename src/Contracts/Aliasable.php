<?php

namespace Baethon\Graphql\Builder\Contracts;

interface Aliasable
{
    public function setAlias(string $alias): void;
}
