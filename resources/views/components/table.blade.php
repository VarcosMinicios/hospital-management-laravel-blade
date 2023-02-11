<fieldset class="row">

    <x-field-group colSize="8">
        <x-select x-data="{}" name="pagination" label="Quantidade de Registros" onchange="pagination(event.target)" data-url="{{$urlPaginate}}"
                  icon="bi bi-list-task" classDiv="w-25">
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </x-select>
    </x-field-group>

    <x-field-group>
        <x-search-input x-data="{}" name="input-search" placeholder="Digite sua pesquisa" x-on:input.debounce.300="searchTable($el.value)" label="Pesquisa"/>
    </x-field-group>

</fieldset>

<div id="table-content" style='position: relative'>
    @if (isset($modal) && $modal)
        @include('table-body-modal')
    @else
        @include('table-body')
    @endif

</div>
