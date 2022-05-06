<?php

namespace App\Domain\Booking\Collections;

use App\Domain\Booking\Entities\Client;
use App\Domain\Booking\Entities\Film;
use App\Domain\Booking\Entities\Ticket;
use DateTimeInterface;
use Iterator;

final class TicketList implements Iterator
{
    /** @var array<Ticket> */
    private array $tickets;

    private int $pointer = 0;

    public function addTicket(Film $film, Client $client, DateTimeInterface $dateTimeStart, DateTimeInterface $dateTimeEnd): void
    {
        $this->tickets[] = new Ticket($film, $client, $dateTimeStart, $dateTimeEnd);
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
