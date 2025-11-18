@include('template.header')

        <div class="container shadow mt-4 p-4">
            <h1>Category List</h1>
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
                @csrf
                <input 
                class="form-control"
                name="category_name"
                placeholder="Category Name"
                value="{{ old('category_name') }}"
                />
                <button class="btn btn-primary my-2">
                    Submit
                </button>
            </form>

            <div class="my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{  $loop->index + 1 }} </td>
                                <td>{{  $data->category_name }} </td>
                                <td>
                                    <a href="category/{{  $data->id }}">Update</a>
                                    <form method="POST" action="category/{{  $data->id }}">
                                        @method('DELETE')
                                         @csrf
                                    <button type="submit">
                                        Delete</submit>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@include('template.footer')