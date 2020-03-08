<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
    
    protected $fillable = [
        'role_id', 'user_id'
    ];
}
