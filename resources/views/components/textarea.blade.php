<!-- resources/views/components/textarea.blade.php -->

@props(['value' => '', 'id' => '', 'name' => '', 'rows' => 4])

<textarea {{ $attributes->merge(['class' => 'block w-full mt-1 text-black']) }} id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}">{{ $value }}</textarea>
