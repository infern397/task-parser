<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'token_id',
        'username',
        'password',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function token()
    {
        return $this->belongsTo(Token::class);
    }
}
