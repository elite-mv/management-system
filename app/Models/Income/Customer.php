<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'company',
        'email',
        'contact_number',
        'address',
        'currency'
    ];
}