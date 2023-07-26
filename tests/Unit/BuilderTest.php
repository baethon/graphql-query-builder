<?php

use Baethon\Graphql\Builder\Arguments;
use Baethon\Graphql\Builder\Builder;
use Baethon\Graphql\Builder\Contracts\Aliasable;
use Baethon\Graphql\Builder\Contracts\Argumentable;
use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\RawValue;

it('casts value to RawValue', function () {
    expect(Builder::raw('"test"'))->toEqual(new RawValue('"test"'));
});

it('creates alias callable', function () {
    $class = new class implements Aliasable
    {
        public $alias = null;

        public function setAlias(string $alias): void
        {
            $this->alias = $alias;
        }
    };

    Builder::alias('foo')($class);

    expect($class->alias)->toEqual('foo');
});

it('creates arguments callable', function ($arguments) {
    $class = new class implements Argumentable
    {
        public $arguments = null;

        public function setArguments(array|Arguments $arguments): void
        {
            $this->arguments = $arguments;
        }
    };

    Builder::arguments($arguments)($class);

    expect($class->arguments)->toEqual($arguments);
})->with([
    'arguments instance' => [new Arguments([])],
    'array' => [[]],
]);

it('creates selectable callable', function () {
    $class = new class implements Selectable
    {
        public $selectors = null;

        public function setSelectors(array $selectors): void
        {
            $this->selectors = $selectors;
        }
    };

    Builder::select(['test'])($class);

    expect($class->selectors)->toEqual(['test']);
});
