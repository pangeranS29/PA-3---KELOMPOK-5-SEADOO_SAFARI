@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'mb-4 text-sm text-red-400']) }}>
        <div class="font-semibold text-red-500">{{ __('Ups! Ada yang salah.') }}</div>

        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
