<label for="{{$name}}" class="form-label pl-5">{{$label}}</label>
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
    <input
        {{ $attributes }}
        type="text"
        class="form-control text-uppercase"
        placeholder="{{$placeholder}}"
        name="{{$name}}"
        id="{{ $id ?? $name }}"
        aria-label="{{$placeholder}}"
        aria-describedby="basic-addon1"
    >
    <button x-data="{}" class="btn btn-outline-secondary" type="button" x-on:click="clearInput($el, '{{$id ?? $name}}')"><span class="bi bi-x-lg text-dark"></span></button>
</div>
