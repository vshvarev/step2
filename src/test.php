<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Booking\Aggregates\MovieSession;
use App\Domain\Booking\Entities\Client;
use App\Domain\Booking\Entities\Film;
use App\Domain\Booking\ValueObjects\ClientPhoneNumber;

$film = new Film('Batman', 173);

$filmShow1 = new MovieSession($film, '2022-05-10 20:00', 10);

$client1 = new Client('Vitaliy', new ClientPhoneNumber('89082222222'));
$client2 = new Client('Nastya', new ClientPhoneNumber('89087777777'));

$filmShow1->bookTicket($client1);
$filmShow1->bookTicket($client2);

print_r($filmShow1->getInfoAboutMovieSession());
