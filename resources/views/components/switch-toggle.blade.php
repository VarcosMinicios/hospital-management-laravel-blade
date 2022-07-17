@if(!$isInlineLabel()) <label for="{{$name}}" class="form-label">{{$label}} @if(str_contains($class, 'required')) * @endif</label> @endif
<div style="display: flex;">
    <div class="form-check form-switch fs-2">
        <input
            x-data
            class="form-check-input {{$class}}"
            type="checkbox"
            role="switch"
            name="{{$name}}"
            {{ $attributes }}
            id="{{ $id }}"
            @if($isDisabled()) disabled @endif
            @if($isChecked()) checked @endif
        >
    </div>
    @if($isInlineLabel()) <label class="form-check-label pt-2" for="{{$name}}">{{$label}}</label> @endif
</div>

