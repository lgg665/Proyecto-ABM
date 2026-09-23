<?php

class Role
{
    public int $id;
    public string $name;
    public ?string $description;

    public function __construct(int $id, string $name, ?string $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (int) $data['id'],
            (string) $data['name'],
            isset($data['description']) ? (string) $data['description'] : null
        );
    }
}
