<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function books() {
        return $this->belongsToMany('\Foobooks\Book')->withTimestamps();
    }

    public static function getTagsForCheckboxes() {
       $tags = \Foobooks\Tag::orderBy('name','ASC')->get();
       $tags_for_checkboxes = [];
       foreach($tags as $tag) {
           $tags_for_checkboxes[$tag['id']] = $tag['name'];
       }
       return $tags_for_checkboxes;
   }
}
