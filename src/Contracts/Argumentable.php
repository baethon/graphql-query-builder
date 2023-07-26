<?php

namespace Baethon\Graphql\Builder\Contracts;

use Baethon\Graphql\Builder\Arguments;

interface Argumentable
{
    public function setArguments(array|Arguments $arguments): void;
}
