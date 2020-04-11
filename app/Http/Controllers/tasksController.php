<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Repository\TaskRepositoryInterface;

class tasksController extends Controller
{
	protected $task;

    public function __construct(TaskRepositoryInterface $task)
    {
        $this->task = $task;
    }
	
    public function index(Request $request)
    {
		$data = $this->task->getUserTasks($request->user()->id);
        return json_encode($data);
    }
	
	public function create()
    {
        $users = $this->task->Users();
		return json_encode($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:128',
            'description' => 'required',
            'due_date' => 'required',
            'users' => 'required',
        ]);
		
		$data = array();
		$data['title'] = $request->input('title');
		$data['description'] = $request->input('description');
		$data['due_date'] = $request->input('due_date');
		$data['users'] = $request->input('users');
		array_push($data['users'],$request->user()->id);

		
        if ($this->task->create($data))
        {
			return response()->json(['success'=>'عملیات ذخیره سازی با موفقیت انجام شد.']); 
        }
        else
        {
            return response()->json(['error'=>'عملیات ذخیره سازی با خطا مواجه شد. لطفا دوباره امتحان کنید.']);
        }
    }

}
