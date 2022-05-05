<?php

namespace App\Domain\Booking\Ticket;

use App\Domain\Booking\Ticket\ValueObject\Film;
use Iterator;

final class TicketList implements Iterator
{
    /** @var array<Ticket> */
    private array $tickets;

    private int $pointer = 0;

    public function createTicketList(int $countOfTickets, Film $film, \DateTime $dateTimeStart, \DateTime $dateTimeEnd): void
    {
        for ($i = 0; $i < $countOfTickets; $i++) {
            $this->tickets[] = new Ticket($i, $film, $dateTimeStart, $dateTimeEnd);
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
