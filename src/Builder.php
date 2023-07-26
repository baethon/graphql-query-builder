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
        return fn (Aliasable $aliasable) => $aliasable->setAlias($alias);
    }

    public static function arguments(array|Arguments $arguments): callable
    {
        return fn (Argumentable $argumentable) => $argumentable->setArguments($arguments);
    }

    public static function select(array $selectors): callable
    {
        return fn (Selectable $selectable) => $selectable->setSelectors($selectors);
    }
}
