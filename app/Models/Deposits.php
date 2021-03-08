<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposits extends Model
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
        'wallet_id',
        'invested',
        'percent',
        'active',
        'duration',
        'accrue_times'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
}
