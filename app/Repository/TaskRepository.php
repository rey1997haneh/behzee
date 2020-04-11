<?php

namespace App\Repository;


use App\Models\Task;
use App\User;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface
{
	
    public function getUserTasks($user_id)
    {
		$user = User::findOrFail($user_id);
        return $user->tasks;
    }

    public function Users()
    {
        return User::all();
    }
	
	public function create(array $data)
    {
        $task = Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'due_date' => $data['due_date'],
        ]);
		
        if ($task)
        {
			$task->users()->attach($data['users']);
			return true; 
        }
        else
        {
            return false;
        }
    }
	
	
}