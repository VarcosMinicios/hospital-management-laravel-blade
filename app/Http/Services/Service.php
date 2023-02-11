<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Service
{

    protected int $length = 10;

    protected int $offset = 0;

    protected int $totalPages = 0;

    protected function tableReturn(Builder $model, string $prefix): array
    {
        return [
            'data' => $model->get()->toArray(),
            'totalRecords' => $this->countRegisters($model),
            'columns' => $this->columns,
            'prefix' => $prefix,
            'url' => route("$prefix.search"),
            'urlPaginate' => route("$prefix.paginate"),
            'length' => $this->length,
            'offset' => $this->offset,
            'totalPages' => $this->totalPages
        ];
    }

    protected function removeMask(string $value): string
    {
        return preg_replace("/\D+/", '', $value);
    }

    protected function countRegisters(Builder $model)
    {
        $count = $model->select(DB::raw('count(*) as total'))->first()->total;
        $this->totalPages = ceil($count / $this->length);

        return $count;
    }
}
