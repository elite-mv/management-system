<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salutation extends Model
{
    use HasFactory;

    protected $fillable = [
        'salutation'
    ];
}