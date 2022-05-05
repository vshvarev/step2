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

    private function getFilm(): Film
    {
        return $this->film;
    }

    private function getDateTimeStart(): DateTime
    {
        return $this->dateTimeStart;
    }

    private function getDateTimeEnd(): DateTime
    {
        return $this->dateTimeEnd;
    }

    private function getId(): int
    {
        return $this->id;
    }

    private function getClient(): Client
    {
        return $this->client;
    }
}
