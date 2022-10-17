<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Valor</th>
            <th scope="col">Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{$item["value"]}}</td>
            <td>{{$item["created_at"]}}</td>
        </tr>
        @endforeach
    </tbody>
</table>