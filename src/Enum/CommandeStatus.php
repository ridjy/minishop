<?php

namespace App\Enum;

enum CommandeStatus : string
{
    case pending = 'pending';
    case paid = 'paid';
    case shipped = 'shipped';
    case cancelled = 'cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::pending => 'En attente',
            self::paid => 'Payé',
            self::shipped => 'Expedié',
            self::cancelled => 'Annulé',
        };
    }
}
