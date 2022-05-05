<?php

namespace App\Domain\Booking\FilmShow;

use App\Domain\Booking\Ticket\TicketList;
use App\Domain\Booking\Ticket\ValueObject\Film;

class FilmShow
{
    private int $duration;
    private mixed $timeEnd;
    private TicketList $tickers;
    private int $countOfTickers;

    public function __construct(
        private Film $film,
        private mixed $date,
        private mixed $timeStart,
    ) {}

    public function createTickers(int $countOfTickers): void
    {
        $ticketList = new TicketList();

        $ticketList->createTicketList($countOfTickers, $this->film, $this->date, $this->timeStart);
        $this->tickers = $ticketList;
        $this->countOfTickers = $countOfTickers;
    }
}
