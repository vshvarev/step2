<?php

namespace App\Domain\Booking\Ticket\ValueObject;

class Film
{
    public function __construct(
        private string $name,
    ) {}

    private function getName(): string
    {
        return $this->name;
    }
}
