<?php

namespace App\Repository;


use App\Models\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
	
    public function getUsers()
	{
		return User::all();
	}

    public function login(array $data)
	{
		
		$user = User::where('email', $data['email'])->first();

		if ($user) 
		{
	
		    if (Hash::check($data['password'], $user->password))
			{
				return $user; 
			}
		    else
			   return false;
		}
	}

    public function register(array $data)
	{
        $user = User::create($data); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
		
		return $success; 
	}
	
	
}