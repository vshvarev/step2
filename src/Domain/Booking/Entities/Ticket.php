<?php

namespace App\Domain\Booking\Entities;

use App\Domain\Booking\Aggregates\MovieSession;
use DateTimeInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Ticket
{
    private UuidInterface $id;

    public function __construct(
        private MovieSession $movieSession,
        private Client $client,
        private DateTimeInterface $dateTimeStart,
        private DateTimeInterface $dateTimeEnd,
    ) {
        $this->id = Uuid::uuid4();
    }
}
