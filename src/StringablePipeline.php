<?php

namespace Baethon\Graphql\Builder;

use Baethon\Graphql\Builder\Templates\NestedSelector;
use Baethon\Graphql\Builder\Templates\Selector;
use Stringable;

class StringablePipeline
{
    public function __construct(
        private array $chunks,
    ) {
    }

    private function normalize(): array
    {
        return array_map(
            function ($item) {
                if (is_string($item)) {
                    return [new Selector($item)];
                }

                if ($item instanceof Stringable) {
                    return [$item];
                }

                if (! is_array($item)) {
                    throw new \InvalidArgumentException('Unsupported type: '.gettype($item));
                }

                $head = Selector::wrap(array_shift($item));
                $modifiers = array_map(
                    fn ($value) => is_array($value)
                        ? tap(new NestedSelector, Builder::select($value))
                        : $value,
                    $item,
                );

                return [$head, ...$modifiers];
            },
            $this->chunks,
        );
    }

    public function __toString()
    {
        $lines = array_map(
            function ($line) {
                $stringable = array_shift($line);

                return array_reduce(
                    $line,
                    fn ($stringable, callable $modifier) => tap($stringable, $modifier),
                    $stringable,
                );
            },
            $this->normalize(),
        );

        return implode("\n", $lines);
    }
}
