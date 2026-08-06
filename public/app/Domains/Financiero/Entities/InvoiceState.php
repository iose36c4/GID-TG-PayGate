<?php

namespace App\Domains\Financiero\Entities;

enum InvoiceState: string
{
    case Created = 'created';
    case Issued = 'issued';
    case PendingPayment = 'pending_payment';
    case Paid = 'paid';
    case Cancelled = 'cancelled';
    case Expired = 'expired';
    case Refunded = 'refunded';
    case Void = 'void';

    /**
     * @return InvoiceState[]
     */
    public function allowedTransitions(): array
    {
        return match ($this) {
            self::Created => [self::Issued, self::Cancelled],
            self::Issued => [self::PendingPayment, self::Cancelled, self::Void],
            self::PendingPayment => [self::Paid, self::Expired, self::Cancelled],
            self::Paid => [self::Refunded],
            self::Cancelled, self::Expired, self::Refunded, self::Void => [],
        };
    }

    public function canTransitionTo(self $to): bool
    {
        return in_array($to, $this->allowedTransitions(), true);
    }

    public function isTerminal(): bool
    {
        return $this->allowedTransitions() === [];
    }

    public function isPaid(): bool
    {
        return $this === self::Paid;
    }
}
