<?php

use Baethon\Graphql\Builder\Arguments;
use Baethon\Graphql\Builder\Builder;
use Baethon\Graphql\Builder\Contracts\Aliasable;
use Baethon\Graphql\Builder\Contracts\Argumentable;
use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\RawValue;
use Baethon\Graphql\Builder\Templates\EmptySelector;
use Baethon\Graphql\Builder\Templates\Selector;

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

    $actual = Builder::alias('foo')($class);

    expect($actual)->not->toEqual($class);
    expect($actual->alias)->toEqual('foo');
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

    $actual = Builder::arguments($arguments)($class);

    expect($actual)->not->toEqual($class);
    expect($actual->arguments)->toEqual($arguments);
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

    $actual = Builder::select(['test'])($class);

    expect($actual)->not->toEqual($class);
    expect($actual->selectors)->toEqual(['test']);
});

it('creates selector callable', function () {
    $class = new class
    {
        public function __toString()
        {
            return '';
        }
    };

    $actual = Builder::selector('test')($class);

    expect($actual)->toEqual(Selector::wrap('test'));
    expect($actual)->not->toEqual($class);
});

it('creates when callable', function (bool $condition, $selector, $expected) {
    $actual = Builder::when($condition)($selector);
    expect($actual)->toEqual($expected);
})->with([
    [
        true,
        Selector::wrap('test'),
        Selector::wrap('test'),
    ],
    [
        false,
        Selector::wrap('test'),
        new EmptySelector,
    ],
]);

it('creates unless callable', function (bool $condition, $selector, $expected) {
    $actual = Builder::unless($condition)($selector);
    expect($actual)->toEqual($expected);
})->with([
    [
        true,
        Selector::wrap('test'),
        new EmptySelector,
    ],
    [
        false,
        Selector::wrap('test'),
        Selector::wrap('test'),
    ],
]);
