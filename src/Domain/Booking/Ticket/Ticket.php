<?php

namespace App\Domain\Booking\Ticket;

use App\Domain\Booking\Ticket\ValueObject\Client;
use App\Domain\Booking\Ticket\ValueObject\Film;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Ticket
{
    private UuidInterface $id;
    private Client $client;

    public function __construct(
        private Film $film,
        private DateTime $dateTimeStart,
        private DateTime $dateTimeEnd,
    ) {
        $this->id = Uuid::uuid4();
    }

    public function bookTicket(Client $client): void
    {
        $this->client = $client;
    }
}
