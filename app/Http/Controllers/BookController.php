<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
        $books = \Foobooks\Book::getAllBooksWithAuthors();

        return view('books.index')->with('books',$books);
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
        $authors_for_dropdown = \Foobooks\Author::authorsForDropdown();

        return view('books.create')->with('authors_for_dropdown', $authors_for_dropdown);
    }
    /**
    * Responds to requests to POST /books/create
    */
    public function postCreate(Request $request) {
        $this->validate($request,[
            'title' => 'required|min:3',
            'author_id' => 'required',
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
        $data = $request->only('title','author_id','published','cover','purchase_link');
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
        $authors_for_dropdown = \Foobooks\Author::authorsForDropdown();
        $tags_for_checkboxes = \Foobooks\Tag::getTagsForCheckboxes();
        # This is used in the view to determine what tags to check
        $tags_for_this_book = [];
        foreach($book->tags as $tag) {
            $tags_for_this_book[] = $tag->id;
        }
        return view('books.edit')
        ->with('book',$book)
        ->with('authors_for_dropdown',$authors_for_dropdown)
        ->with('tags_for_checkboxes',$tags_for_checkboxes)
        ->with('tags_for_this_book',$tags_for_this_book);
    }

    /**
    * Responds to requests to GET /books/create
    */
    public function postEdit(Request $request) {
        $book = \Foobooks\Book::find($request->id);
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->published = $request->published;
        $book->cover = $request->cover;
        $book->purchase_link = $request->purchase_link;

        # If there were tags selected...
        if($request->tags) {
            $tags = $request->tags;
        }
        # If there were no tags selected (i.e. no tags in the request)
        # default to an empty array of tags
        else {
            $tags = [];
        }

        $book->tags()->sync($tags);

        $book->save();

        \Session::flash('message','Your changes were saved.');
        return redirect('/book/edit/'.$request->id);
    }
}
