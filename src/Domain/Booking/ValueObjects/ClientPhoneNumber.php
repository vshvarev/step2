<?php

namespace App\Domain\Booking\ValueObjects;

class ClientPhoneNumber
{
    public function __construct(
        private string $phoneNumber,
    ) {
        $this->phoneNumber = self::validatePhoneNumber($this->phoneNumber);
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
