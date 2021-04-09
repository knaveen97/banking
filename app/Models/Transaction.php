<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_user_id',
        'from_account_id',
        'to_user_id',
        'to_account_id',
        'amount',
        'trans_type',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function account()
    {
        return $this->belongsToMany(Account::class);
    }
}
