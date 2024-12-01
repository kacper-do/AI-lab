<?php

namespace App\Model;

class Vehicle
{
    private ?int $id;
    private string $make;
    private string $type;

    public function __construct(?int $id = null, string $make = '', string $type = '')
    {
        $this->id = $id;
        $this->make = $make;
        $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function setMake(string $make): void
    {
        $this->make = $make;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
