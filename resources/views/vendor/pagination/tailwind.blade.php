@if ($paginator->hasPages())
    <nav class="flex justify-center" role="navigation">
        {{-- Previous link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-indigo-300 text-indigo-900 rounded-l-lg">
                Previous
            </span>
        @else
            <a
                href="{{ $paginator->previousPageUrl() }}"
                class="px-4 py-2 bg-indigo-900 text-white rounded-l-lg hover:bg-indigo-600"
            >
                Previous
            </a>
        @endif
        {{-- Pagination elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span
                    class="px-4 py-2 bg-indigo-300 hover:bg-indigo-500 hover:text-white text-indigo-900"
                >
                    {{ $element }}
                </span>
            @endif

            {{-- Array of links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-indigo-900 text-white">
                            {{ $page }}
                        </span>
                    @else
                        <a
                            href="{{ $url }}"
                            class="px-4 py-2 bg-indigo-300 text-indigo-900 hover:text-white hover:bg-indigo-600"
                        >
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next link --}}

        @if ($paginator->hasMorePages())
            <a
                href="{{ $paginator->nextPageUrl() }}"
                class="px-4 py-2 bg-indigo-900 text-white rounded-r-lg hover:bg-indigo-600"
            >
                Next
            </a>
        @else
            <span class="px-4 py-2 bg-indigo-300 text-indigo-900 rounded-r-lg">
                Next
            </span>
        @endif
    </nav>
@endif
