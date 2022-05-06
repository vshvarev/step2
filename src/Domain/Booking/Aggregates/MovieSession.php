<?php

namespace App\Domain\Booking\Aggregates;

use App\Domain\Booking\Collections\TicketList;
use App\Domain\Booking\Entities\Film;
use App\Domain\Booking\ValueObjects\Client;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class MovieSession
{
    private UuidInterface $id;
    private DateTime $dateTimeStartMovieSession;
    private DateTime $dateTimeEndMovieSession;
    private TicketList $tickets;
    private int $countOfRemainingTickets = 0;

    public function __construct(
        private Film $film,
        private string $dateTime,
        private int $countOfTickets,
    ) {
        $this->id = Uuid::uuid4();
        $this->setDateAndTime($this->dateTime);
        $this->createTickers($this->countOfTickets);
    }

    public function createTickers(int $countOfTickets): void
    {
        $ticketList = new TicketList();

        $ticketList->createTicketList($countOfTickets, $this->film, $this->dateTimeStartMovieSession, $this->dateTimeEndMovieSession);
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
            'Дата' => $this->dateTimeStartMovieSession->format('d F Y'),
            'Время начала сеанса' => $this->dateTimeStartMovieSession->format('H:i'),
            'Продолжительность фильма' => $this->getDuration(),
            'Время окончания сеанса' => $this->dateTimeEndMovieSession->format('H:i'),
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
        $this->dateTimeStartMovieSession = new DateTime($dateTime);
        $this->dateTimeEndMovieSession = new DateTime($dateTime);
        $minutesToAdd = $this->film->getDuration();
        $this->dateTimeEndMovieSession->modify("+{$minutesToAdd} minutes");
    }

    private function ticketsSoldOut(): bool
    {
        return $this->countOfRemainingTickets <= 0;
    }
}
