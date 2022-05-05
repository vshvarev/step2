<?php

namespace App\Domain\Booking\FilmShow;

use App\Domain\Booking\Ticket\TicketList;
use App\Domain\Booking\Ticket\ValueObject\Client;
use App\Domain\Booking\Ticket\ValueObject\Film;

class FilmShow
{
    private int $duration;
    private mixed $timeEnd;
    private TicketList $tickers;
    private int $countOfTickers;

    public function __construct(
        private int $id,
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

    public function bookTicket(Client $client): void
    {
        $ticker = $this->tickers->current();
        $ticker->bookTicket($client);
        $this->tickers->next();
    }

    private function getId(): int
    {
        return $this->id;
    }
}
