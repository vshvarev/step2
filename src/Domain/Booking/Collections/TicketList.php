<?php

namespace App\Domain\Booking\Collections;

use App\Domain\Booking\Entities\Film;
use App\Domain\Booking\Entities\Ticket;
use DateTime;
use Iterator;

final class TicketList implements Iterator
{
    /** @var array<Ticket> */
    private array $tickets;

    private int $pointer = 0;

    public function createTicketList(int $countOfTickets, Film $film, DateTime $dateTimeStart, DateTime $dateTimeEnd): void
    {
        for ($i = 0; $i < $countOfTickets; $i++) {
            $this->tickets[] = new Ticket($film, $dateTimeStart, $dateTimeEnd);
        }
    }

    public function current(): Ticket
    {
        return $this->tickets[$this->pointer];
    }

    public function next(): void
    {
        $this->pointer++;
    }

    public function key(): int
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return isset($this->tickets[$this->pointer]);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}
