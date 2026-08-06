<?php

namespace App\Domains\Financiero\Entities;

enum PaymentState: string
{
    case Created = 'pending';
    case PendingConfirmation = 'processing';
    case WaitingConfirmation = 'waiting_confirmation';
    case Paid = 'completed';
    case Cancelled = 'cancelled';
    case Expired = 'expired';
    case RefundRequested = 'refund_requested';
    case Refunded = 'refunded';
    case Disputed = 'disputed';
    case Chargeback = 'chargeback';
    case Frozen = 'frozen';
    case Failed = 'failed';

    /**
     * @return PaymentState[]
     */
    public function allowedTransitions(): array
    {
        return match ($this) {
            self::Created => [self::PendingConfirmation, self::WaitingConfirmation, self::Paid, self::Cancelled, self::Expired, self::Failed],
            self::PendingConfirmation => [self::WaitingConfirmation, self::Paid, self::Cancelled, self::Expired, self::Failed],
            self::WaitingConfirmation => [self::Paid, self::Expired, self::Cancelled, self::Failed],
            self::Paid => [self::RefundRequested, self::Disputed, self::Chargeback, self::Frozen],
            self::RefundRequested => [self::Refunded, self::Frozen],
            self::Disputed => [self::Refunded, self::Chargeback, self::Frozen],
            self::Chargeback => [self::Refunded, self::Frozen],
            self::Frozen => [self::Refunded],
            self::Cancelled, self::Expired, self::Refunded, self::Failed => [],
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
