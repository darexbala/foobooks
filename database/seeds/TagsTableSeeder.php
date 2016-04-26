<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $data = ['novel','fiction','classic','wealth','women','autobiography','nonfiction'];

        foreach($data as $tagName) {
            $tag = new \Foobooks\Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
