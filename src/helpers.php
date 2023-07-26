<?php

namespace Baethon\Graphql\Builder;

/**
 * @template T
 *
 * @param  T  $value
 * @param  Closure(T):void  $fn
 * @return T
 */
function tap($value, callable $fn)
{
    $fn($value);

    return $value;
}
