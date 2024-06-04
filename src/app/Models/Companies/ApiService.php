<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiService extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'token_id',
    ];

    public function accounts()
    {
        return $this->hasManyThrough(
            Account::class,
            Token::class,
            'api_service_id',
            'token_id',
            'id',
            'id'
        );
    }

    public function tokenTypes()
    {
        return $this->hasOne(TokenType::class);
    }
}
