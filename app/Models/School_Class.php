<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School_Class extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_leader_id',
        'student_id'
    ];


    
}
