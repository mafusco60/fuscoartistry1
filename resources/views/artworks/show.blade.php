<x-layout>
    <a
        href="{{ route('artworks.index') }}"
        class="text-indigo-900 text-md my-4 py-2 px-8 rounded-xl hover:opacity-80 border border-rounded-lg"
    >
        <i class="fa-solid fa-arrow-alt-circle-left"></i>
        Back to Artworks
    </a>

    <div class="mx-4">
        <div
            class="text-lg inline text-rose-900 mb-4 border rounded-xl py-2 px-6"
        >
            {{-- Display Artwork Image and Details --}}
            <div class="grid grid-cols-1 md:grid-cols-8 gap-6">
                {{-- Row 1 -- Cols 1-3 --}}

                <div
                    class="md:col-span-3 px-5 pt-5 border border-gray-300 bg-indigo-100 rounded-xl"
                >
                    <h3 class="text-2xl text-center font-bold mt-10">
                        "{{ $artwork->title }}"
                    </h3>
                    <h2
                        class="text-xl text-center text-indigo-900 font-bold mb-10"
                    >
                        {{ ucwords($artwork->medium) }}
                    </h2>

                    @if ($artwork->original)
                        <h2 class="text-lg text-center text-indigo-900">
                            Original: ${{ $artwork->original_price }}
                        </h2>
                        <h2 class="text-lg text-center text-indigo-900">
                            Substrate:
                            {{ ucwords($artwork->original_substrate) }}
                        </h2>
                        <h2 class="text-l text-center text-indigo-900 mb-2">
                            Dimensions: {{ $artwork->original_dimensions }}
                        </h2>
                    @else
                        <h2 class="text-center">Original Not Available</h2>
                    @endif
                </div>
                {{-- Row 1 - Cols 4-6 --}}
                <div
                    class="md:col-span-3 px-5 pt-5 border border-gray-300 bg-indigo-100 rounded-x"
                >
                    <a
                        href="{{ asset($artwork->image) }}"
                        data-fancybox="gallery"
                        data-caption="{{ $artwork->title }}"
                    >
                        <img
                            class="w-[250px] mr-6 mb-6 rounded-xl"
                            src="{{ asset($artwork->image) }}"
                            alt="{{ $artwork->title }}"
                        />
                    </a>
                </div>

                {{-- Row 1 - Cols 7-8 --}}
                <div
                    class="md:col-span-2 text-end p-5 border border-gray-300 bg-yellow-50 rounded-x"
                >
                    Placeholder for Column 7-8
                    <h1 class="w-full font-bold mt-6 text-end">Print Lookup</h1>
                    <h2 class="text-lg text-indigo-900 mt-4">
                        <a href="{{ url('pricings') }}">Price Chart</a>
                    </h2>
                </div>

                {{-- Row 2 - Cols 1-6 --}}
                <div
                    class="md:col-span-6 p-5 border border-gray-300 bg-indigo-100"
                >
                    <h2 class="text-2xl font-bold mb-4 mr-5 text-rose-900">
                        Description
                    </h2>
                    <h3
                        class="text-lg text-indigo-900 space-y-6 font-normal text-justify"
                    >
                        {{ $artwork->description }}
                    </h3>
                </div>

                {{-- Row 2 - Cols 7-8 --}}
                {{-- Edit (temp) --}}
                <div
                    class="md:col-span-2 text-end border p-5 border-gray-300 bg-yellow-50 rounded-x"
                >
                    <a href="{{ route('artworks.edit', $artwork->id) }}">
                        <button
                            class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-700"
                        >
                            Edit
                        </button>
                    </a>

                    {{-- Delete Form (temp) --}}
                    <form
                        method="POST"
                        action="{{ route('artworks.destroy', $artwork->id) }}"
                        onsubmit="return confirm('Are you sure you want to delete {{ $artwork->title }} ?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="px-4 py-2 bg-rose-500 text-white rounded hover:bg-rose-700"
                        >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            {{-- Contact Artist Button --}}
            <div class="mt-10 grid grid-cols-5">
                <div class="col-start-3 col-span-2 w-full">
                    <x-button-link
                        url="/messages"
                        icon="envelope"
                        textClass="text-white"
                        bgClass="bg-indigo-900"
                        hoverClass="hover:bg-indigo-700"
                    >
                        Contact Artist
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>
</x-layout>
