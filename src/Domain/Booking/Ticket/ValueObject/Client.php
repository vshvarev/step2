<?php

namespace App\Domain\Booking\Ticket\ValueObject;

final class Client
{
    public function __construct(
        private string $name,
        private string $phoneNumber,
    ) {
        $this->phoneNumber = self::validatePhoneNumber($phoneNumber);
    }

    private function getName(): string
    {
        return $this->name;
    }

    private function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    private static function validatePhoneNumber(string $phoneNumber): string
    {
        $regexpCorrectNumber = '/^\s?(\+\s?7|8)([- ()]*\d){10}$/';

        if (preg_match($regexpCorrectNumber, $phoneNumber)) {
            return $phoneNumber;
        }

        return '----------';
    }
}
