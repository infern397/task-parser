<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
