<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddBookRequest;
use App\Models\Book;


class BookController extends Controller
{
    public function add_book(AddBookRequest $request, $user_id, Book $book)
    {
        $book->name = $request->bookName;
        $book->description = $request->bookText;
        $book->book_author = $this->get_user_id();
        $book->save();

        return redirect('/profile/library/'.$user_id);
    }

    public function show_book($user_id, $book_id)
    {   
        $book = $this->get_book($book_id);
        return view('book', ['book' => $book, 'user_id' => $this->get_user_id()]);
    }

    public function show_book_unreg($book_id)
    {
        $book = $this->get_book($book_id);
        return view('book', ['book' => $book, 'user_id' => NULL]);
    }

    public function edit_book_form($user_id, $book_id)
    {
        $book = $this->get_book_user($book_id);
        if(!$book)
        {
            return redirect('/profile/library/'.$user_id.'/read/'.$book_id);
        }
        return view('edit_book', ['book' => $book]);
    }

    public function get_book($book_id)
    {
        return Book::find($book_id);
    }

    public function get_book_user($book_id)
    {
        return Book::where('book_author', '=', $this->get_user_id())
            ->where('id', '=', $book_id)->first();
    }

    public function save_book(AddBookRequest $request, $user_id, $book_id)
    {
        $book = $this->get_book_user($book_id);

        if($book)
        {
            $book->name = $request->bookName;
            $book->description = $request->bookText;
            $book->save();
        }
        
        return redirect('profile/library/'.$user_id.'/read/'.$book_id);
    }

    public function delete_book($user_id, $book_id)
    {
        $book = $this->get_book_user($book_id);

        if($book)
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