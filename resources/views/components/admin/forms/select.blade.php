@props([
    'label',
    'id',
    'name',
    'options' => [],
    'selected' => ''
])
<div class="mt-2">
    <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $name }}" {{ $attributes }} class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
     @foreach($options as $key => $option)
         <option value="{{ $key }}" @if($key === $selected) selected @endif>{{ $option }}</option>
     @endforeach
    </select>
</div>
