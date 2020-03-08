<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

  

    protected $fillable = [
        'role_id', 'user_id'
    ];
}
