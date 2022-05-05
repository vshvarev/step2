<?php

namespace App\Domain\Booking\Ticket\ValueObject;

class Client
{
    public function __construct(
        private string $name,
        private string $phoneNumber,
    ) {
        $phoneNumber = $this->validatePhoneNumber($phoneNumber);
        $this->phoneNumber = $phoneNumber;
    }

    private function validatePhoneNumber(string $phoneNumber): string
    {
        return $phoneNumber;
    }

    private function getName(): string
    {
        return $this->name;
    }

    private function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
