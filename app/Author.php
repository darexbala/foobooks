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
}
