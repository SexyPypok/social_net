<?php

namespace App\Http\Controllers;
use App\Models\LibAccessNonAuth;


use Illuminate\Http\Request;

class LibAccessNonAuthController extends Controller
{
    public function share_by_link($user_id, $book_id, LibAccessNonAuth $lib_access)
    {
        $lib_access->book_id = $book_id;
        $lib_access->save();

        return redirect('/profile/library/'.$user_id);
    }

    public function hide_by_link($user_id, $book_id)
    {
        $book_rights = LibAccessNonAuth::where('book_id', '=', $book_id)->first();
        
        if($book_rights)
        {
            $book = $book_rights->book;
            $book_author = $book->book_author;

            if($this->get_user_id() == $book_author)
            {
                $book_rights->delete();
            }
        }

        return redirect('/profile/library/'.$user_id);
    }
}
