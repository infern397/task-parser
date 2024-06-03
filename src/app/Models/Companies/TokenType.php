<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'api_service_id',
    ];

    public function apiServices()
    {
        return $this->belongsToMany(ApiService::class, 'api_service_token_type');
    }

    // Связь с токенами
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}
