<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RequestItemImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'request_item_id'
    ];

    protected $appends = ['public_image'];

    public function getPublicImageAttribute(){
        return Storage::url($this->file);
    }
}
