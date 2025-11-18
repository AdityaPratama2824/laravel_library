@include('template.header')

<div class="container mt-5 bg-warning p-5 text-center">
    <div class="row">
    
        @if(session('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif
    <div class="col-lg-6 col-md-6 col-12">
            <a href="/book">
                <div class="card bg-success text-light m-2">
                    <h1>BOOK</h1>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <a href="/admin/book">
                <div class="card bg-primary text-light m-2">
                    <h1>ADMIN</h1>
                </div>
            </a>
        </div>
    </div>
</div>

@include('template.footer')
