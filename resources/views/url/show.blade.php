@extends('index')

@section('content')
    <div class="container mt-4">
        <h1>Site: {{$url->name}}</h1>
        <form action="/urls/{{$url->id}}/checks" method="post">
            @csrf
            <input type="submit" value="Check URL">
        </form>
        @include('url.check.index')
    </div>
@endsection