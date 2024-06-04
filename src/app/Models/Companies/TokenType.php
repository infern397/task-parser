<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];
}
