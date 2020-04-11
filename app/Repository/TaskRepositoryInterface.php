<?php

namespace App\Repository;

interface TaskRepositoryInterface
{
	
    public function getUserTasks($user);
	
	public function Users();

    public function create(array $data);
	
}