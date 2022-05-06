<?php

namespace App\Domain\Booking\Entities;

use DateTimeInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Ticket
{
    private UuidInterface $id;

    public function __construct(
        private Film $film,
        private Client $client,
        private DateTimeInterface $dateTimeStart,
        private DateTimeInterface $dateTimeEnd,
    ) {
        $this->id = Uuid::uuid4();
    }

    public function bookTicket(Client $client): void
    {
        $this->client = $client;
    }
}
