<div data-backdrop="static" class="div-loading-table" id="div-loading-table" style="display: none">
    <div class="d-flex justify-content-center span-loading">
        <div class="row border border-4 rounded bg-light">
            <span class="text-dark fw-bold fs-4">Processando</span>
        </div>
    </div>
</div>

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

<div class="row">

    <div class="col-md-2">
        <span>Exibindo {{$totalRecords > $length ? $length : $totalRecords}} de {{$totalRecords}}</span>
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
