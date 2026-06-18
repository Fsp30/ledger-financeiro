<?php

namespace App\Domain;

use App\Domain\ValueObjects\Currency;
use InvalidArgumentException;

final class Money
{
    private function __construct(
        private readonly int $cents,
        private readonly Currency $currency,
    ) {
        if ($this->cents < 0) {
            throw new InvalidArgumentException(
                'Amount must be greater than or equal to zero'
            );
        }
    }

    public static function fromFloat(
        float $amount,
        Currency $currency = Currency::BRL
    ): self {
        if (!is_finite($amount)) {
            throw new InvalidArgumentException(
                'Invalid monetary amount'
            );
        }

        $cents = (int) round($amount * 100);

        if (abs(($cents / 100) - $amount) > 1e-9) {
            throw new InvalidArgumentException(
                'Amount must have at most 2 decimal places'
            );
        }

        return new self($cents, $currency);
    }

    public static function fromCents(
        int $cents,
        Currency $currency = Currency::BRL
    ): self {
        return new self($cents, $currency);
    }

    public function add(self $other): self
    {
        $this->assertSameCurrency($other);

        return new self(
            $this->cents + $other->cents,
            $this->currency
        );
    }

    public function subtract(self $other): self
    {
        $this->assertSameCurrency($other);

        return new self(
            $this->cents - $other->cents,
            $this->currency
        );
    }

    public function equals(self $other): bool
    {
        return $this->cents === $other->cents
            && $this->currency === $other->currency;
    }

    public function cents(): int
    {
        return $this->cents;
    }

    public function amount(): float
    {
        return $this->cents / 100;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    private function assertSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException(
                'Cannot operate on different currencies'
            );
        }
    }
}