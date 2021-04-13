@extends('index')

@section('content')
    <div class="container mt-4">
        <h1>Page Analizator</h1>
        <div>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/" method="POST">
                @csrf
                <label for="name">Name</label>
                <input id="name" type="text" name="url[name]">
                <input type="submit" value="Add URL">
            </form>
        </div>
    </div>
@endsection
