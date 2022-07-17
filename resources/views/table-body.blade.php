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
                <td>
                    <a href="{{route("$prefix.show", $item['id'])}}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                    <a href="{{route("$prefix.edit", $item['id'])}}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                    <a data-url="{{route("$prefix.destroy", $item['id'])}}" x-data="{}" x-on:click="axiosDelete($el)" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
    </tfoot>
</table>
