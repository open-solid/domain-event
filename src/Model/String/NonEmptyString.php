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

namespace OpenSolid\Domain\Model\String;

use OpenSolid\Domain\Error\InvariantViolation;

class NonEmptyString extends Str
{
    /** @var int<1,max> */
    protected const MIN_LENGTH = 1;
    /** @var int<1,max> */
    protected const MAX_LENGTH = 255;
    /** @var string */
    protected const EMPTY_ERROR_MESSAGE = 'String cannot be empty.';
    /** @var string */
    protected const MIN_LENGTH_ERROR_MESSAGE = 'String cannot be shorter than %d characters.';
    /** @var string */
    protected const MAX_LENGTH_ERROR_MESSAGE = 'String cannot be longer than %d characters.';

    public static function from(string $value): static
    {
        $string = (new static($value))->trim();

        if ($string->isEmpty()) {
            throw InvariantViolation::create(static::EMPTY_ERROR_MESSAGE);
        }

        if ($string->length() < static::MIN_LENGTH) {
            throw InvariantViolation::create(sprintf(static::MIN_LENGTH_ERROR_MESSAGE, static::MIN_LENGTH));
        }

        if ($string->length() > static::MAX_LENGTH) {
            throw InvariantViolation::create(sprintf(static::MAX_LENGTH_ERROR_MESSAGE, static::MAX_LENGTH));
        }

        return $string;
    }
}
