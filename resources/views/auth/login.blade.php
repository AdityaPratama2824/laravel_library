@include('template.header')

<div class="container mt-5">
    <div class="d-flex justify-content-center">
        <div class="card p-4" style="width: 22rem;">

            <h4 class="text-center mb-3">Login</h4>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="enter email..."
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        placeholder="enter password..."
                    >
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>

                <div class="mt-3 text-center">
                    <a href="/register">don't have account?</a>
                </div>

            </form>

        </div>
    </div>
</div>

@include('template.footer')
