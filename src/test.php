<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Booking\FilmShow\FilmShow;
use App\Domain\Booking\Ticket\ValueObject\Film;

$film = new Film('Batman');
$filmShow1 = new FilmShow($film, 15, 14);
$filmShow1->createTickers(3);
