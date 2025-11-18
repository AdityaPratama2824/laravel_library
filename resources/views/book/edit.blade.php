<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link  href="{{ asset('style/bootstrap.min.css') }}" rel="stylesheet" />
        
    </head>
    <body>
        <div class="container shadow mt-4 p-4">
            <h1>Update Book!</h1>
            @if (session("success"))
                <div class="alert alert-success">
                    {{ session("success") }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <select 
                            class="form-control mb-2"
                            name="category_id"
                            value="{{ $book->category_id }}"
                            >
                            <option value=""> Select Category </option>
                            @foreach ($categories as $category)
                                <option 
                                @if($category->id == $book->category_id)
                                    {{ "selected" }}
                                @endif
                                value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <input 
                            class="form-control mb-2"
                            name="title"
                            placeholder="Title"
                            value="{{ $book->title }}"
                            />
                        <input 
                            class="form-control mb-2"
                            name="author"
                            placeholder="Author"
                            value="{{ $book->author }}"
                            />
                    </div>
                    <div class="col-lg-6 col-12">
                        <input 
                            class="form-control mb-2"
                            type="number"
                            name="qty"
                            placeholder="qty"
                            value="{{ $book->qty }}"
                            />
                        <input 
                            class="form-control mb-2"
                            type="number"
                            name="year"
                            placeholder="year"
                            value="{{ $book->year }}"
                            />
                        <button class="btn btn-primary my-2">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
