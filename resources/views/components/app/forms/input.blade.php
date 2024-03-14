@props([
    'name',
    'id',
    'label' => '',
    'type' => 'text',
    'required' => false,
    'value' => '',
    'placeholder' => ''
])
<div>
    @if(!empty($label))
        <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    @endif

    <div class="relative mt-2 rounded-md shadow-sm">
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="block w-full rounded-md border-0 py-1.5 pr-10 text-red-900 ring-1 ring-inset @error($name) ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 @enderror sm:text-sm sm:leading-6" placeholder="{{ $placeholder }}" value="{{ $value }}" aria-invalid="true" aria-describedby="{{ $id }}-error">
        @error($name)
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
        </div>
        @enderror

    </div>
    @error($name)
    <p class="mt-2 text-sm text-red-600" id="{{$id}}-error">{{ $message }}</p>
    @enderror

</div>
