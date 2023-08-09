<?php

namespace Baethon\Graphql\Builder;

use Baethon\Graphql\Builder\Templates\Selector;
use Stringable;

class StringablePipeline
{
    public function __construct(
        private array $chunks,
    ) {
    }

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
                : $value,
            $item,
        );

        return [$head, ...$modifiers];
    }

    public function __toString()
    {
        $lines = array_map(
            function ($line) {
                $normalized = $this->normalize($line);
                $stringable = array_shift($normalized);

                return array_reduce(
                    $normalized,
                    fn ($stringable, callable $modifier) => $modifier($stringable),
                    $stringable,
                );
            },
            $this->chunks,
        );

        return implode("\n", $lines);
    }
}
