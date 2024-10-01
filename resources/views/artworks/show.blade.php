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
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                {{-- Row 1 --}}
                <div
                    class="md:col-span-2 px-5 pt-5 border border-gray-200 bg-indigo-100 rounded-x"
                >
                    <img
                        class="w-[250px] mr-6 mb-6 rounded-xl"
                        src="{{ asset($artwork->image) }}"
                        alt=""
                    />
                </div>

                <div
                    class="md:col-span-2 px-5 pt-5 border border-gray-200 bg-indigo-100 rounded-xl"
                >
                    <h3 class="text-2xl font-bold mt-10">
                        "{{ $artwork->title }}"
                    </h3>
                    <h2 class="text-xl text-indigo-900 font-bold mb-10">
                        {{ ucwords($artwork->medium) }}
                    </h2>

                    @if ($artwork->original)
                        <h2 class="text-lg text-indigo-900">
                            Original: ${{ $artwork->original_price }}
                        </h2>
                        <h2 class="text-lg text-indigo-900">
                            Substrate:
                            {{ ucwords($artwork->original_substrate) }}
                        </h2>
                        <h2 class="text-lg text-indigo-900 mb-2">
                            Dimensions: {{ $artwork->original_dimensions }}
                        </h2>
                    @else
                        <h2 class="text-center">Original Not Available</h2>
                    @endif
                </div>
                <div
                    class="md:col-span-1 text-end border border-gray-200 bg-yellow-50 rounded-x"
                >
                    Placeholder for Column 5
                    <h1
                        class="border border-gray-200 w-full font-bold mt-6 text-end"
                    >
                        Print Lookup
                    </h1>
                    <h2 class="text-lg text-indigo-900 mt-4">
                        <a href="{{ url('pricings') }}">Price Chart</a>
                    </h2>
                </div>

                {{-- Row 2 --}}
                <div class="md:col-span-4 mt-5">
                    <h2 class="text-2xl font-bold mb-4 mr-5 text-rose-900">
                        Description
                    </h2>
                    <h3
                        class="text-lg text-indigo-900 space-y-6 font-normal text-justify"
                    >
                        {{ $artwork->description }}
                    </h3>
                </div>
                <div
                    class="md:col-span-1 text-end border border-gray-200 bg-yellow-50 rounded-x"
                >
                    Placeholder for Row 2 Column 5
                </div>
            </div>
            {{-- Contact Artist Button --}}
            <div class="mt-10 grid grid-cols-5">
                <div class="col-start-3 col-span-2 w-full">
                    <x-button-link
                        url="/contact"
                        icon="envelope"
                        textClass="text-white"
                    >
                        Contact Artist
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>
</x-layout>
