@props(['disabled' => false, 'options' => [], 'selected' => ''])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    <option value=""></option>
    @foreach ($options as $key => $val)
        <option value="{{ $key }}" @if ($selected == $key) selected @endif>{{ $val }}
        </option>
    @endforeach
</select>
