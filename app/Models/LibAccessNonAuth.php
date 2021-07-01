<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibAccessNonAuth extends Model
{
    use HasFactory;

    protected $table = 'books_access_non_auth';

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
