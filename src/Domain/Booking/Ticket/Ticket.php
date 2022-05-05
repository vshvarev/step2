<?php

namespace App\Domain\Booking\Ticket;

use App\Domain\Booking\Ticket\ValueObject\Client;
use App\Domain\Booking\Ticket\ValueObject\Film;

class Ticket
{
    private Client $client;

    public function __construct(
        private Film $film,
        private mixed $date,
        private mixed $time,
    ) {}

    private function getFilm(): Film
    {
        return $this->film;
    }

    private function getDate(): mixed
    {
        return $this->date;
    }

    private function getTime(): mixed
    {
        return $this->time;
    }
}
