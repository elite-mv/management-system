<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItemImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'request_item_id'
    ];
    
}
