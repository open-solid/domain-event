<?php

declare(strict_types=1);

/*
 * This file is part of OpenSolid package.
 *
 * (c) Yonel Ceruto <open@yceruto.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenSolid\Domain\Model\Integer;

readonly class Integer implements \Stringable
{
    public static function from(int $value): self
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function greaterThan(self $other): bool
    {
        return $this->value() > $other->value();
    }

    public function greaterThanOrEqual(self $other): bool
    {
        return $this->value() >= $other->value();
    }

    public function lessThan(self $other): bool
    {
        return $this->value() < $other->value();
    }

    public function lessThanOrEqual(self $other): bool
    {
        return $this->value() <= $other->value();
    }

    public function multiply(self $factor): self
    {
        return static::from($this->value() * $factor->value());
    }

    public function divide(self $divisor): self
    {
        return static::from(intdiv($this->value(), $divisor->value()));
    }

    public function module(self $divisor): self
    {
        return static::from($this->value() % $divisor->value());
    }

    public function toString(): string
    {
        return (string) $this->value();
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    final protected function __construct(
        private int $value,
    ) {
    }
}
