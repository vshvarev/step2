<?php

namespace App\Domain\Booking\Aggregates;

use App\Domain\Booking\Collections\TicketList;
use App\Domain\Booking\Entities\Client;
use App\Domain\Booking\Entities\Film;
use DateTime;
use DateTimeInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class MovieSession
{
    private UuidInterface $id;
    private DateTimeInterface $dateTimeStartMovieSession;
    private DateTimeInterface $dateTimeEndMovieSession;
    private TicketList $tickets;

    public function __construct(
        private Film $film,
        private string $dateTime,
        private int $countOfTickets,
    ) {
        $this->id = Uuid::uuid4();
        $this->setDateAndTime($this->dateTime);
        $this->tickets = new TicketList();
    }

    public function bookTicket(Client $client): void
    {
        if ($this->ticketsSoldOut()) {
            return;
        }

        $this->tickets->addTicket($this->film, $client, $this->dateTimeStartMovieSession, $this->dateTimeEndMovieSession);
        $this->countOfTickets--;
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
            'Количество свободных мест' => $this->countOfTickets,
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
        return $this->countOfTickets <= 0;
    }
}
