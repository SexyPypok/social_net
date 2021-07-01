<?php

namespace App\Http\Controllers;
use App\Models\LibAccessNonAuth;


use Illuminate\Http\Request;

class LibAccessNonAuthController extends Controller
{
    protected $lib_access;
    protected $user;

    public function __construct()
    {
        $this->lib_access = new LibAccessNonAuth();
        $this->user = new UserController();
    }

    public function share_by_link($user_id, $book_id)
    {
        $this->lib_access->book_id = $book_id;
        $this->lib_access->save();

        return redirect('/profile/library/'.$user_id);
    }

    public function hide_by_link($user_id, $book_id)
    {
        $book_rights = $this->lib_access->where('book_id', '=', $book_id)->first();
        $book = $book_rights->book;
        if($book->book_author == $this->user->get_user_id())
        {
            $book_rights->delete();
        }
        
        return redirect('/profile/library/'.$user_id);
    }
}
