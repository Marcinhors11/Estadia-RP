@if (session('success'))
    <div class="alert alert-success col-md-5 m-auto mt-3 text-center">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger col-md-5 m-auto mt-3 text-center">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger col-md-5 m-auto mt-3 text-center">
        <ul style="list-style: none">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif
