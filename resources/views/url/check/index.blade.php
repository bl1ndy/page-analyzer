<div class="container">
    <h2>Checks</h2>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Response code</th>
                    <th scope="col">H1</th>
                    <th scope="col">Keywords</th>
                    <th scope="col">Description</th>
                    <th scope="col">Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checks as $check)
                    <tr>
                        <td>{{$check->id}}</td>
                        <td>{{$check->status_code}}</td>
                        <td>{{$check->h1}}</td>
                        <td>{{$check->keywords}}</td>
                        <td>{{$check->description}}</td>
                        <td>{{$check->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                {{$checks->links()}}
            </ul>
        </nav>
    <div>
</div>
