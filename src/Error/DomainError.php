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

namespace OpenSolid\Domain\Error;

class DomainError extends \DomainException
{
    /** @var string */
    protected const DEFAULT_MESSAGE = 'A domain error occurred.';

    private array $errors = [];

    /**
     * @param array<self> $errors
     */
    public static function createMany(array $errors): static
    {
        $messages = array_map(static fn (self $error) => $error->getMessage(), $errors);
        $messages = implode(' ', $messages);

        $self = static::create($messages);
        $self->errors = $errors;

        return $self;
    }

    public static function create(?string $message = null, int $code = 0, ?\Throwable $previous = null): static
    {
        return new static($message ?? static::DEFAULT_MESSAGE, $code, $previous);
    }

    /**
     * @return array<self>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    final protected function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
