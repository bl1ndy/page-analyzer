<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a href="/">Home</a>
        <h1>URLS</h1>
        <div>
            @include('flash::message')
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($urls as $url)
                        <tr>
                            <td>{{$url->id}}</td>
                            <td><a href="{{route('urls.show', $url->id)}}">{{$url->name}}</td>
                            <td>{{$url->created_at}}</td>
                            <td>{{$url->updated_at}}</td>
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
</body>