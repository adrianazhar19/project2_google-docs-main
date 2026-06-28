<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentPresence extends Model
{
    protected $fillable = [
        'document_id',
        'user_id',
        'is_typing',
    ];
}
