<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;


class BookController extends Controller
{
    //
    public function add_book(Request $request, $user_id)
    {
        $user = new UserController();
        $book = new Book();
        $book->name = $request->bookName;
        $book->description = $request->bookText;
        $book->book_author = $user->get_user_id();
        $book->save();

        return redirect('/profile/library/'.$user_id);
    }

    public function show_book($user_id, $book_id)
    {   
        $user = new UserController();
        $book = $this->get_book($book_id);
        return view('book', ['book' => $book, 'user_id' => $user->get_user_id()]);
    }

    public function show_book_unreg($book_id)
    {
        $book = $this->get_book($book_id);
        return view('book', ['book' => $book, 'user_id' => NULL]);
    }

    public function edit_book_form($user_id, $book_id)
    {
        $book = $this->get_book($book_id);
        return view('edit_book', ['book' => $book]);
    }

    public function get_book($book_id)
    {
        $book = new Book();
        return $book->find($book_id);
    }

    public function save_book(Request $request, $user_id, $book_id)
    {
        $book = $this->get_book($book_id);
        $book->name = $request->bookName;
        $book->description = $request->bookText;
        $book->save();
        return redirect('profile/library/'.$user_id.'/read/'.$book->id);
    }

    public function delete_book($user_id, $book_id)
    {
        $book = $this->get_book($book_id);
        $user = new UserController();
        $author_id = $user->get_profile_id(NULL);
        if($author_id == $book->book_author)
        {
            $book->delete();
        }

        return redirect('/profile/library/'.$user_id);
    }

    public function add_book_form($user_id)
    {
        return view('add_book', ['user_id' => $user_id]);
    }
}
// profile/library/{id}