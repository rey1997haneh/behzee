<?php

namespace App\Repository;

interface UserRepositoryInterface
{
	
    public function getUsers();

    public function login(array $data);

    public function register(array $data);
	
}