<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books() {
        # Author has many Books
        # Define a one-to-many relationship.
        return $this->hasMany('\Foobooks\Book');
    }

    public static function authorsForDropdown() {
        # Get all authors
        $authors = \Foobooks\Author::orderBy('last_name','ASC')->get();
        # Build array for author's dropdown
        $authors_for_dropdown = [];
        foreach($authors as $author) {
            $authors_for_dropdown[$author->id] = $author->last_name.', '.$author->first_name;
        }
        return $authors_for_dropdown;
    }
}
