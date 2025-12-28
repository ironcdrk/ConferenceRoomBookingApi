<?php

namespace App\Domain\Rooms\Entities;

class Room
{
    private string $id;
    private string $name;
    private int $capacity;
    private bool $active;

    public function __construct(
        string $id,
        string $name,
        int $capacity,
        bool $active = true
    ) {
        if ($capacity <= 0) {
            throw new \InvalidArgumentException('Capacity must be greater than zero');
        }

        $this->id = $id;
        $this->name = $name;
        $this->capacity = $capacity;
        $this->active = $active;
    }

    public function deactivate(): void
    {
        $this->active = false;
    }

    public function capacity(): int
    {
        return $this->capacity;
    }
}
