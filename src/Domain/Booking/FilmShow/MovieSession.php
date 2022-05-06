<?php

namespace App\Domain\Booking\FilmShow;

use App\Domain\Booking\Ticket\TicketList;
use App\Domain\Booking\Ticket\ValueObject\Client;
use App\Domain\Booking\Ticket\ValueObject\Film;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class MovieSession
{
    private UuidInterface $id;
    private DateTime $dateTimeStart;
    private DateTime $dateTimeEnd;
    private TicketList $tickets;
    private int $countOfTickets;
    private int $countOfRemainingTickets = 0;

    public function __construct(
        private Film $film,
    ) {
        $this->id = Uuid::uuid4();
    }

    public function createTickers(int $countOfTickets): void
    {
        $ticketList = new TicketList();

        $ticketList->createTicketList($countOfTickets, $this->film, $this->dateTimeStart, $this->dateTimeEnd);
        $this->tickets = $ticketList;
        $this->countOfTickets = $countOfTickets;
        $this->countOfRemainingTickets = $countOfTickets;
    }

    public function bookTicket(Client $client): void
    {
        if ($this->ticketsSoldOut()) {
            return;
        }

        $ticket = $this->tickets->current();
        $ticket->bookTicket($client);
        $this->tickets->next();
        $this->countOfRemainingTickets--;
    }

    /** @return array<mixed> */
    public function getInfoAboutFilmShow(): array
    {
        return [
            'Название фильма' => $this->film->getName(),
            'Дата' => $this->dateTimeStart->format('d F Y'),
            'Время начала сеанса' => $this->dateTimeStart->format('H:i'),
            'Продолжительность фильма' => $this->getDuration(),
            'Время окончания сеанса' => $this->dateTimeEnd->format('H:i'),
            'Количество свободных мест' => $this->countOfRemainingTickets,
        ];
    }

    /** @return array<int> */
    public function getDuration(): array
    {
        $hours = intdiv($this->film->getDuration(), 60);
        $minutes = $this->film->getDuration() % 60;

        return ['hours' => $hours, 'minutes' => $minutes];
    }

    public function setDateAndTime(string $dateTime): void
    {
        $this->dateTimeStart = new DateTime($dateTime);
        $this->dateTimeEnd = new DateTime($dateTime);
        $minutesToAdd = $this->film->getDuration();
        $this->dateTimeEnd->modify("+{$minutesToAdd} minutes");
    }

    private function ticketsSoldOut(): bool
    {
        return $this->countOfRemainingTickets <= 0;
    }
}
