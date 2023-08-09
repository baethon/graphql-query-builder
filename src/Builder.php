<?php

namespace Baethon\Graphql\Builder;

use Baethon\Graphql\Builder\Contracts\Aliasable;
use Baethon\Graphql\Builder\Contracts\Argumentable;
use Baethon\Graphql\Builder\Contracts\Selectable;

class Builder
{
    public static function raw($value): RawValue
    {
        return new RawValue($value);
    }

    public static function alias(string $alias): callable
    {
        return function (Aliasable $aliasable) use ($alias) {
            $copy = clone $aliasable;
            $copy->setAlias($alias);

            return $copy;
        };
    }

    public static function arguments(array|Arguments $arguments): callable
    {
        return function (Argumentable $argumentable) use ($arguments) {
            $copy = clone $argumentable;
            $copy->setArguments($arguments);

            return $copy;
        };
    }

    public static function select(array $selectors): callable
    {
        return function (Selectable $selectable) use ($selectors) {
            $copy = clone $selectable;
            $copy->setSelectors($selectors);

            return $copy;
        };
    }
}
