@extends('index')

@section('content')
    <div class="container mt-4">
        <h1>Site: {{$url[0]->name}}</h1>
        <form action="/urls/{id}/checks" method="post">
            @csrf
            <input type="button" value="Check URL">
        </form>
    </div>
@endsection