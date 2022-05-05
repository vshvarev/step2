<?php

namespace App\Domain\Booking\Ticket\ValueObject;

final class Film
{
    public function __construct(
        private string $name,
        private int $duration,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }
}
