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
                            name="book_id">
                            <option value="{{ $borrow->book_id }}">{{ $books->where('id', $borrow->book_id)->first()->title ?? 'ANjing'}}</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>                                
                            @endforeach
                        </select>
                        <select 
                            class="form-control mb-2"
                            name="user_id">
                            <option value="{{ $borrow->user_id }}">{{ $users->where('id', $borrow->user_id)->first()->name ?? "Unknown User"}}</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>                                
                            @endforeach
                        </select> 

                    </div>
                    <div class="col-lg-6 col-12">
                        <input 
                            class="form-control mb-2"
                            name="start_borrow"
                            type="date"
                            placeholder="Start Borrow"
                            value="{{ $borrow->start_borrow }}"
                            />
                        <input 
                            class="form-control mb-2"
                            name="qty"
                            placeholder="Quantity"
                            value="{{ $borrow->qty }}"
                            />
                        </div>
                        <button class="btn btn-primary my-2">
                            Submit
                        </button>
                </div>
            </form>
        </div>
    </body>
</html>