<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'office_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}
