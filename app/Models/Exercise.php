<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['post_id', 'exercisename','duration', 'weight', 'description', 'date'];
}
