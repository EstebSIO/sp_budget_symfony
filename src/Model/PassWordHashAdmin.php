<?php

namespace App\Model;

interface PassWordHashAdmin
{
    public function getRoles(): array;

    public function setRoles(array $roles): self;

    public function getPassword(): string;

    public function setPassword(string $password): self;
}