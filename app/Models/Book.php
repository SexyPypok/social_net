<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'book_author', 'id');
    }

    public function share_status()
    {
        return $this->hasOne(LibAccessNonAuth::class, 'book_id', 'id');
    }
}
