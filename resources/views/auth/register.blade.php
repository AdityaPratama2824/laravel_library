@include('template.header')

<div class="container m-5">
    <div class="d-flex justify-content-center">
        <div class="card p-3" style="width: 20rem;">

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

            <form method="post" action="/register">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="fill your name here..">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="fill your email here..">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="fill your password here..">
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>

                <div class="mt-3 text-center">
                    <a href="/login">already have account?</a>
                </div>
            </form>

        </div>
    </div>
</div>

@include('template.footer')
