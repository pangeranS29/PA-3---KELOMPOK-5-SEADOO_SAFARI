@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex justify-center items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="block px-3 py-1 text-gray-500 border border-gray-700 rounded cursor-not-allowed">
                        &laquo;
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="block px-3 py-1 text-yellow-500 border border-yellow-500 rounded hover:bg-yellow-500 hover:text-black transition">
                        &laquo;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-1 text-gray-400">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="block px-3 py-1 bg-yellow-500 text-black rounded font-bold">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="block px-3 py-1 text-yellow-500 border border-yellow-500 rounded hover:bg-yellow-500 hover:text-black transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="block px-3 py-1 text-yellow-500 border border-yellow-500 rounded hover:bg-yellow-500 hover:text-black transition">
                        &raquo;
                    </a>
                </li>
            @else
                <li>
                    <span class="block px-3 py-1 text-gray-500 border border-gray-700 rounded cursor-not-allowed">
                        &raquo;
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
