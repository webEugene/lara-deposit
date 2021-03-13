<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    public bool $timestamps = false;
    protected array $dates = ['created_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'type',
        'user_id',
        'wallet_id',
        'deposit_id',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function deposits()
    {
        return $this->belongsToMany(Deposits::class);
    }
}
