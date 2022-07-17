<fieldset class="row">

    <x-field-group colSize="8">
        <x-select name="pagination" label="Quantidade de Registros" icon="bi bi-list-task" classDiv="w-25">
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </x-select>
        {{-- //TODO: Do the pagination method and create a person component for this --}}
    </x-field-group>

    <x-field-group>
        <x-input x-data="{}" name="input-search" x-on:input.debounce.500="searchRenderTable($el.value)" label="Pesquisa"
            icon="bi bi-search"
        />
    </x-field-group>

</fieldset>

<div id="table-content">
    @if (isset($modal) && $modal)
        @include('table-body-modal')
    @else
        @include('table-body')
    @endif

</div>
