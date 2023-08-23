<?php

namespace Baethon\Graphql\Builder\Templates;

use Baethon\Graphql\Builder\RawValue;

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

    public function __toString()
    {
        $mapped = array_map(
            fn ($key, $value) => "{$key}: {$this->wrapValue($key, $value)}",
            array_keys($this->argumentsList),
            array_values($this->argumentsList),
        );

        return implode(', ', $mapped);
    }

    private function wrapValue($key, $value): string
    {
        if (is_array($value)) {
            return sprintf('[%s]', implode(
                ', ',
                array_map(fn ($value) => $this->wrapValue('', $value), $value),
            ));
        }

        if ($this->shouldQuote($key, $value)) {
            return sprintf('"%s"', $value);
        }

        if (is_bool($value)) {
            return match ($value) {
                true => 'true',
                false => 'false',
            };
        }

        return $value;
    }

    private function shouldQuote(string $key, $value): bool
    {
        if (str_starts_with($key, '$')) {
            return false;
        }

        if ($value instanceof RawValue) {
            return false;
        }

        if (is_int($value) || is_float($value) || is_bool($value) || is_array($value)) {
            return false;
        }

        if (str_starts_with($value, '$')) {
            return false;
        }

        // ENUM_OPTION
        if (preg_match('/^([A-Z]+_)?[A-Z]+$/', $value)) {
            return false;
        }

        // [SOMETHING] / [SOMETHING]!
        if (preg_match('/^\[.+?\]\!?$/', $value)) {
            return false;
        }

        return true;
    }
}
