<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','author','published','cover','purchase_link'];

    public function author() {
        return $this->belongsTo('\Foobooks\Author');
    }

    public function tags() {
        return $this->belongsToMany('\Foobooks\Tag')->withTimestamps();
    }

    public static function getAllBooksWithAuthors() {
        return \Foobooks\Book::with('author')->orderBy('id','desc')->get();
    }
}
