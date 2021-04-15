@extends('index')

@section('content')
    <div class="container mt-4">
        <h1>Page Analizator</h1>
        <div>
            <form action="{{ route('home') }}" method="POST">
                @csrf
                <label for="name">Name</label>
                <input id="name" type="text" name="url[name]">
                <input type="submit" value="Add URL">
            </form>
        </div>
    </div>
@endsection
