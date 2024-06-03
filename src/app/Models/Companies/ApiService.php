<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function tokenTypes()
    {
        return $this->belongsToMany(TokenType::class, 'api_service_token_type');
    }
}
