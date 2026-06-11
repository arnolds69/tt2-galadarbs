<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'type', 'private', 'category', 'user_id', 'viewcount'];

    public function user() {
    return $this->belongsTo(\App\Models\User::class);
    }
    public function exercises() {
    return $this->hasMany(\App\Models\Exercise::class);
    }
}