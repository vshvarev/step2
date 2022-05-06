<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Booking\FilmShow\MovieSession;
use App\Domain\Booking\Ticket\ValueObject\Client;
use App\Domain\Booking\Ticket\ValueObject\Film;

$film = new Film('Batman', 173);

$filmShow1 = new MovieSession($film);

$filmShow1->setDateAndTime('2022-05-10 20:00');
$filmShow1->createTickers(10);

$client1 = new Client('Vitaliy', '89082222222');
$client2 = new Client('Nastya', '89087777777');

$filmShow1->bookTicket($client1);
$filmShow1->bookTicket($client2);

print_r($filmShow1->getInfoAboutFilmShow());
