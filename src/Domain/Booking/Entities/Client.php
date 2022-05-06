<?php

namespace App\Domain\Booking\Entities;

use App\Domain\Booking\ValueObjects\ClientPhoneNumber;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Client
{
    private UuidInterface $id;

    public function __construct(
        private string $name,
        private ClientPhoneNumber $phoneNumber,
    ) {
        $this->id = Uuid::uuid4();
    }

    private function getName(): string
    {
        return $this->name;
    }

    private function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
