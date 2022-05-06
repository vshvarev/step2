<?php

namespace App\Domain\Booking\Ticket;

use App\Domain\Booking\Ticket\ValueObject\Client;
use App\Domain\Booking\Ticket\ValueObject\Film;
use DateTime;

final class Ticket
{
    private Client $client;

    public function __construct(
        private int $id,
        private Film $film,
        private DateTime $dateTimeStart,
        private DateTime $dateTimeEnd,
    ) {}

    public function bookTicket(Client $client): void
    {
        $this->client = $client;
    }
}
