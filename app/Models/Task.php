<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['task_name', 'status', 'open', 'task_start', 'task_final', 'task_timer', 'rest_timer', 'is_ready'];
}
