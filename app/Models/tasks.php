<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{

    protected $fillable = ['user_id', 'project_id', 'description', 'start_time', 'end_time', 'taskname'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects()
    {
        return $this->belongsTo(project::class, 'project_id');
    }
}
