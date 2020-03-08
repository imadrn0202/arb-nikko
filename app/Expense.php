<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expense extends Model
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
        'category_id', 'amount', 'entry_date', 'user_id'
    ];


    public function expenseCategory()
    {
        return $this->hasOne('App\ExpenseCategory', 'id', 'category_id');
    }
}
