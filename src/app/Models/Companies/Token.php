<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'token_type_id',
        'token',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function tokenType()
    {
        return $this->belongsTo(TokenType::class);
    }
}
