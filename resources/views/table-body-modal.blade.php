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
                    @if(Route::has("$prefix.destroy"))
                        <a data-url="{{route("$prefix.destroy", $item['id'])}}" x-on:click="axiosDelete($el)" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
    </tfoot>
</table>

<div class="row">

    <div class="col-md-2">
        <span>Exibindo {{$length}} de {{$totalRecords}}</span>
    </div>

    <div class="col offset-md-7">
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" role="button" aria-label="Previous">
                        <span>&laquo;</span>
                    </a>
                </li>

                @for ($i = 1; $i <= 5; $i++)
                    <li class="page-item">
                        <a class="page-link" role="button" x-on:click='pagination($el)'>{{$i}}</a>
                    </li>
                @endfor

                <li class="page-item">
                    <a class="page-link" role="button" aria-label="Next">
                    <span>&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
