<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Task extends Model
{
    protected $table = 'tasks';
    protected $guarded = ['id'];
    protected $dateFormat = 'U';
	
	public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
