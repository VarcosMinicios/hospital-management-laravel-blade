<label for="{{$name}}" class="form-label pl-5">{{$label}} @if(str_contains($class, 'required')) * @endif</label>
<div class="input-group mb-3 {{$classDiv}}">
    <span class="input-group-text" id="basic-addon1"><i class="{{$icon}}"></i></span>
    <input
        {{ $attributes }}
        @if($isDisabled()) disabled @endif
        @if($isReadonly()) readonly @endif
        @if ($classPrimary) x-init="setMask($el, '{{$classPrimary}}')" @endif
        value="{{$value}}"
        type="{{$type}}"
        class="form-control text-uppercase {{$class}}"
        placeholder="{{$placeholder}}"
        name="{{$name}}"
        id="{{ $id }}"
        aria-label="{{$placeholder}}"
        aria-describedby="basic-addon1"
    >
</div>
