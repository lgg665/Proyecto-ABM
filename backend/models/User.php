<?php

class User
{
    public ?int $id;
    public string $firstName;
    public string $lastName;
    public string $username;
    public string $email;
    public int $roleId;
    public ?string $roleName;

    public function __construct(
        ?int $id,
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        int $roleId,
        ?string $roleName = null
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->email = $email;
        $this->roleId = $roleId;
        $this->roleName = $roleName;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            (string) $data['first_name'],
            (string) $data['last_name'],
            (string) $data['username'],
            (string) $data['email'],
            (int) $data['role_id'],
            isset($data['role_name']) ? (string) $data['role_name'] : null
        );
    }
}
