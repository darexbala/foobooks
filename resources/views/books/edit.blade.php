@extends('layouts.master')

@section('title')
    Edit book {{ $book->title }}
@stop

@section('content')

<h1>Add a new book</h1>

    <form method='POST' action='/book/edit'>

        {{ csrf_field() }}
        <input type="hidden" name='id' value='{{ $book->id }}'>
        <div class='form-group'>
           <label>Title:</label>
            <input
                type='text'
                id='title'
                name='title'
                value='{{ $book->title }}'
            >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>

        <div class='form-group'>
           <label for="author_id">Author:</label>
           <select name='author_id' id='author_id'>
               @foreach($authors_for_dropdown as $author_id => $author_name)

                    <?php $selected  = ($book->author_id == $author_id) ? 'SELECTED' : '' ?>
                    <option value='{{$author_id}}' {{ $selected}}>{{$author_name}}</option>
                @endforeach
           </select>
           <div class='error'>{{ $errors->first('author') }}</div>
        </div>

        <div class='form-group'>
           <label>Published Year (YYYY):</label>
           <input
               type='text'
               id='published'
               name='published'
               value='{{ $book->published  }}'
           >
           <div class='error'>{{ $errors->first('Published') }}</div>
        </div>

        <div class='form-group'>
           <label>URL of cover image:</label>
           <input
               type='text'
               id='cover'
               name='cover'
               value='{{ $book->cover }}'
           >
           <div class='error'>{{ $errors->first('cover') }}</div>
        </div>

        <div class='form-group'>
           <label>URL to purchase this book:</label>
           <input
               type='text'
               id='purchase_link'
               name='purchase_link'
               value='{{ $book->purchase_link  }}'
           >
           <div class='error'>{{ $errors->first('purchase_link') }}</div>
        </div>
        <div class='form-group'>
            @foreach($tags_for_checkboxes as $tag_id => $tag_name)
                <input
                    type='checkbox'
                    value='{{ $tag_id }}'
                    name='tags[]'
                    {{ (in_array($tag_id,$tags_for_this_book)) ? 'CHECKED' : '' }}
                >
                {{$tag_name}} <br>
            @endforeach
        </div>
        <div class='form-instructions'>
            All fields are required
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>

        {{--
        <ul class=''>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        --}}

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>


@stop
