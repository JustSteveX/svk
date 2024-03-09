@props(['disabled' => false, 'placeholder' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'rounded-md shadow-sm border-gray-300
focus:ring-0 ',
]) !!} placeholder="{{$placeholder}}">
