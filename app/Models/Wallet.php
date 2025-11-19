<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use PDO;

class Wallet extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'wallets';

    protected $fillable = ['name', 'user_id', 'currency_id'];

    public function Currency()
    {
        return $this->belongsTo(Currencies::class, 'currency_id');
    }

    public function Transaction()
    {
        return $this->hasMany(Transaction::class, 'wallet_id', 'id');
    }
}
