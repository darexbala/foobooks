<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
        $books = \Foobooks\Book::orderby('id', 'desc')->get();

        return view('books.index')->with('books', $books);
    }
    /**
    * Responds to requests to GET /books/show/{id}
    */
    public function getShow($title = null) {
        return view('books.show',[
            'title' => $title,
        ]);
    }
    /**
    * Responds to requests to GET /books/create
    */
    public function getCreate() {
        return view('books.create');
    }
    /**
    * Responds to requests to POST /books/create
    */
    public function postCreate(Request $request) {
        $this->validate($request,[
            'title' => 'required|min:3',
            'author' => 'required',
            'published' => 'required|min:4',
            'cover' => 'required|url',
            'purchase_link' => 'required|url'
        ]);

        // $book = new \Foobooks\Book();
        // $book->title = $request->title;
        // $book->author = $request->author;
        // $book->published = $request->published;
        // $book->cover = $request->cover;
        // $book->purchase_link = $request->purchase_link;
        $data = $request->only('title','author','published','cover','purchase_link');
        //$book = new \Foobooks\Book($data);
        //$book->save();

        # Mass Assignment 2
        \Foobooks\Book::create($data);

        \Session::flash('message','Your book was added.');
        return redirect('/books');
    }

    /**
    * Responds to requests to GET /books/create
    */
    public function getEdit($id) {
        $book = \Foobooks\Book::find($id);

        return view('books.edit')->with('book', $book);
    }

    /**
    * Responds to requests to GET /books/create
    */
    public function postEdit(Request $request) {
        $book = \Foobooks\Book::find($request->id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published = $request->published;
        $book->cover = $request->cover;
        $book->purchase_link = $request->purchase_link;

        $book->save();
        
        \Session::flash('message','Your changes were saved.');
        return redirect('/book/edit/'.$request->id);
    }
}
