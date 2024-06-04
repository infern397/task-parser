<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'api_service_id',
        'username',
        'password',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function apiService()
    {
        return $this->belongsTo(ApiService::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function getValidToken()
    {
        $apiService = $this->apiService;

        foreach ($apiService->tokenTypes as $tokenType) {
            $token = $this->tokens()->where('token_type_id', $tokenType->id)->first();
            if ($token) {
                return $token->token;
            }
        }

        return null;
    }
}
