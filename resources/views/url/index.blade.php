@extends('index')

@section('content')
    <div class="container">
        <h1>URLS</h1>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Last check</th>
                        <th scope="col">Status code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($urls as $url)
                        <tr>
                            <td>{{$url->id}}</td>
                            <td><a href="{{route('urls.show', $url->id)}}">{{$url->name}}</td>
                            <td>{{$url->last_check}}</td>
                            <td>{{$url->last_status_code}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    {{$urls->links()}}
                </ul>
            </nav>
        <div>
    </div>
@endsection
