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

    // Связь с компанией
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Связь с API сервисом
    public function apiService()
    {
        return $this->belongsTo(ApiService::class);
    }

    // Связь с токенами
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}
