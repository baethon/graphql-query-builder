<?php

namespace Baethon\Graphql\Builder;

use Baethon\Graphql\Builder\Templates\Selector;
use Stringable;

class Pipeline
{
    private function normalize(array|string|Stringable $item): array
    {
        if (is_string($item)) {
            return [new Selector($item)];
        }

        if ($item instanceof Stringable) {
            return [$item];
        }

        $head = Selector::wrap(array_shift($item));
        $modifiers = array_map(
            fn ($value) => is_array($value)
                ? Builder::select($value)
                : Selector::wrap($value),
            $item,
        );

        return [$head, ...$modifiers];
    }

    public function reduceLine(array|string|Stringable $item)
    {
        $normalized = $this->normalize($item);
        $head = array_shift($normalized);

        return array_reduce(
            $normalized,
            fn ($stringable, callable $modifier) => $modifier($stringable),
            $head,
        );
    }
}
