<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\ClassString;

class Wallet extends Model
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
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deposits()
    {
        return $this->hasOne(Deposits::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
}
