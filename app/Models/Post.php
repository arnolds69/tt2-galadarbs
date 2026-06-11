<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
   
    protected $fillable = ['title', 'type', 'private', 'category', 'user_id', 'viewcount'];

    public function user() {
    return $this->belongsTo(\App\Models\User::class);
    }
    public function exercises() {
    return $this->hasMany(\App\Models\Exercise::class);
    }
}