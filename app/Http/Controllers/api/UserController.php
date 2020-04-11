<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepositoryInterface;

class UserController extends Controller 
{
	protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }
	
	public $successStatus = 200;
		 
    public function index()
    {
		$data = $this->user->getUsers();
        return json_encode($data);
    }
	
    public function login(Request $request)
	{		
		$data = array();
		$data['email'] = $request->input('email');
		$data['password'] = $request->input('password');
		
		$result = $this->user->login($data);
		
		if ($result) 
		{
			$success['token'] = $result->createToken('MyApp')->accessToken;
			return $success;
		}
		else
			return response()->json(['error'=>'Unauthorised'], 401);
		
    }
	 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

		if ($validator->fails()) 
		{ 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
		
		$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        /*$user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;*/
		
		$success = $this->user->register($input);
		
		return response()->json(['success'=>$success], $this-> successStatus); 
    }
	
}