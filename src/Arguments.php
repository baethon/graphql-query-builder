<?php

namespace Baethon\Graphql\Builder;

final class Arguments
{
    public function __construct(
        private array $argumentsList,
    ) {
    }

    public static function wrap(array|Arguments $arguments): Arguments
    {
        return $arguments instanceof Arguments
            ? $arguments
            : new self($arguments);
    }
}
