<table class="table table-striped table-bordered border" data-url="{{$url}}">
    <thead>
        <tr>
            @foreach($columns as $column)
                <th scope="col">{{mb_strtoupper($column)}}</th>
                @if ($loop->last)
                    <th scope="col">AÇÕES</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                @foreach ($columns as $key => $value)
                    <td class="text-uppercase">{{$item[$key]}}</td>
                @endforeach
                <td x-data="{}">
                    <a data-url="{{route("$prefix.show", $item['id'])}}" x-on:click="loadModal($el)" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                    <a data-url="{{route("$prefix.edit", $item['id'])}}" x-on:click="loadModal($el)" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                    <a data-url="{{route("$prefix.destroy", $item['id'])}}" x-on:click="axiosDelete($el)" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
    </tfoot>
</table>
