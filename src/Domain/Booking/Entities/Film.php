<?php

namespace App\Domain\Booking\Entities;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Film
{
    private UuidInterface $id;

    public function __construct(
        private string $name,
        private int $duration,
    ) {
        $this->id = Uuid::uuid4();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }
}
