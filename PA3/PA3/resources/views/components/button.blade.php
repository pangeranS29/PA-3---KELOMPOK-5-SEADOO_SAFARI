<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-5 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-semibold text-sm rounded-lg shadow transition duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2'
]) }}>
    {{ $slot }}
</button>
