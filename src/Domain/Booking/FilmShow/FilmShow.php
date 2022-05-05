<?php

namespace App\Domain\Booking\FilmShow;

use App\Domain\Booking\Ticket\ValueObject\Film;

class FilmShow
{
    private int $duration;

    public function __construct(
        private Film $film,
        private mixed $date,
        private mixed $timeStart,
        private mixed $timeEnd,
        private object $tickets,
    ) {}
}
