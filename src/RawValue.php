<?php

namespace Baethon\Graphql\Builder;

use Stringable;

final class RawValue implements Stringable
{
    public function __construct(private string $rawValue)
    {
    }

    public static function quote(mixed $value): RawValue
    {
        return new self(sprintf('"%s"', $value));
    }

    public function __toString(): string
    {
        return $this->rawValue;
    }
}
