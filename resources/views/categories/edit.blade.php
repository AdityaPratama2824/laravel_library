<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link  href="{{ asset('/style/bootstrap.min.css') }}" rel="stylesheet" />
        
    </head>
    <body>
        <div class="container shadow mt-4 p-4">
            <h1>Update Category!</h1>
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
            <form method="POST" >
                 @method('PUT')
                @csrf

                <input type="hidden" value="{{ $data->id }}"/>
                <input 
                class="form-control"
                name="category_name"
                placeholder="Category Name"
                value="{{ $data->category_name }}"
                />
                <div class="d-flex justify-content-between my-4">
                    <a href="{{ route('category.show', $data->id) }}">Back to Categories List</a>

                    <button class="btn btn-primary my-2">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>
