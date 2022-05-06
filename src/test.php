<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Booking\Aggregates\MovieSession;
use App\Domain\Booking\Entities\Film;
use App\Domain\Booking\ValueObjects\Client;

$film = new Film('Batman', 173);

$filmShow1 = new MovieSession($film, '2022-05-10 20:00', 10);

$client1 = new Client('Vitaliy', '89082222222');
$client2 = new Client('Nastya', '89087777777');

$filmShow1->bookTicket($client1);
$filmShow1->bookTicket($client2);

print_r($filmShow1->getInfoAboutFilmShow());
