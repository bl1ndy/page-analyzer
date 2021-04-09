<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
    <h1>URLS</h1>
    <div>
        @include('flash::message')
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Created at</td>
                    <td>Updated at</td>
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

        {{$urls->links()}}
    <div>
</body>