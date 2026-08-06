<?php

namespace App\Domains\Financiero\ValueObjects;

use InvalidArgumentException;

final class Money
{
    public function __construct(
        private readonly int $cents,
        private readonly string $currency = 'ARS',
    ) {
        if ($this->cents < 0) {
            throw new InvalidArgumentException('Money cannot be negative.');
        }
    }

    public static function fromCents(int $cents, string $currency = 'ARS'): self
    {
        return new self($cents, $currency);
    }

    public static function fromDecimal(float|string|int $amount, string $currency = 'ARS'): self
    {
        $normalized = number_format((float) $amount, 2, '.', '');

        return new self((int) round((float) $normalized * 100), $currency);
    }

    public function cents(): int
    {
        return $this->cents;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function amount(): string
    {
        return number_format($this->cents / 100, 2, '.', '');
    }

    public function equals(Money $other): bool
    {
        return $this->currency === $other->currency && $this->cents === $other->cents;
    }

    public function add(Money $other): self
    {
        $this->assertSameCurrency($other);

        return new self($this->cents + $other->cents, $this->currency);
    }

    public function subtract(Money $other): self
    {
        $this->assertSameCurrency($other);
        $result = $this->cents - $other->cents;

        if ($result < 0) {
            throw new InvalidArgumentException('Money result cannot be negative.');
        }

        return new self($result, $this->currency);
    }

    private function assertSameCurrency(Money $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException(
                sprintf('Currency mismatch: %s vs %s', $this->currency, $other->currency),
            );
        }
    }
}
