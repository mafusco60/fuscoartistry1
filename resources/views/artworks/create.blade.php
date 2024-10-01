<x-layout>
    {{-- <x-card class="p-10 max-w-lg mx-auto mt-24"> --}}
    <header class="text-center">
        <h2 class="text-2xl font-bold mb-1">Add an Artwork</h2>
        <p class="mb-4"></p>
    </header>

    <form method="POST" action="/artworks" enctype="multipart/form-data">
        @csrf

        <div class="mb-2">
            <label for="image" class="inline-block text-sm mb-2">Image</label>
            <input
                type="file"
                class="text-sm border focus:outline-none @error('image') border-rose-500 @enderror rounded p-2 w-full"
                name="image"
                id="image"
            />
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <label for="medium" class="inline-block text-sm mb-2">Medium</label>
            <select
                class="text-sm border focus:outline-none rounded p-2 w-full"
                name="medium"
                id="medium"
            >
                <option
                    value="Other"
                    {{ old('medium') == 'Other' ? 'selected' : '' }}
                >
                    Other
                </option>
                <option
                    value="Graphite"
                    {{ old('medium') == 'Graphite' ? 'selected' : '' }}
                >
                    Graphite
                </option>
                <option
                    value="Color Pencil"
                    {{ old('medium') == 'Color Pencil' ? 'selected' : '' }}
                >
                    Color Pencil
                </option>
                <option
                    value="Charcoal"
                    {{ old('medium') == 'Charcoal' ? 'selected' : '' }}
                >
                    Charcoal
                </option>
                <option
                    value="Alcohol Marker"
                    {{ old('medium') == 'Alcohol Marker' ? 'selected' : '' }}
                >
                    Alcohol Marker
                </option>
                <option
                    value="Ink"
                    {{ old('medium') == 'Ink' ? 'selected' : '' }}
                >
                    Ink
                </option>
                <option
                    value="Oil Painting"
                    {{ old('medium') == 'Oil Painting' ? 'selected' : '' }}
                >
                    Oil Painting
                </option>
                <option
                    value="Oil Pastel"
                    {{ old('medium') == 'Oil Pastel' ? 'selected' : '' }}
                >
                    Oil Pastel
                </option>
                <option
                    value="Soft Pastel"
                    {{ old('medium') == 'Soft Pastel' ? 'selected' : '' }}
                >
                    Soft Pastel
                </option>
                <option
                    value="Acrylic Painting"
                    {{ old('medium') == 'Acrylic Painting' ? 'selected' : '' }}
                >
                    Acrylic Painting
                </option>
                <option
                    value="Watercolor"
                    {{ old('medium') == 'Watercolor' ? 'selected' : '' }}
                >
                    Watercolor
                </option>
                <option
                    value="Mixed Media"
                    {{ old('medium') == 'Mixed Media' ? 'selected' : '' }}
                >
                    Mixed Media
                </option>
                <option
                    value="Digital Art"
                    {{ old('medium') == 'Digital Art' ? 'selected' : '' }}
                >
                    Digital Art
                </option>
            </select>

            @error('medium')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <label for="title" class="inline-block text-sm mb-2">
                Artwork Title
            </label>
            <input
                type="text"
                class="text-sm border rounded p-2 w-full focus:outline-none @error('title') border-rose-500 @enderror"
                name="title"
                placeholder="Example: The Dancer"
                value="{{ old('title') }}"
                id="title"
            />

            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <label for="search_tags" class="inline-block text-sm mb-2">
                Tags
            </label>
            <input
                type="text"
                class="text-sm border focus:outline-none rounded p-2 w-full"
                name="search_tags"
                id="search_tags"
                placeholder="Example: Dancer, Ballet, Graceful"
                value="{{ old('search_tags') }}"
            />

            @error('search_tags')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <label for="description" class="inline-block text-sm mb-2">
                Artwork Description
            </label>
            <textarea
                class="text-sm border focus:outline-none @error('description') border-rose-500 @enderror rounded p-2 w-full"
                name="description"
                id="description"
                rows="3"
            >
            {{ old('description') }}
            </textarea>

            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <label
                for="featured"
                class="inline-block focus:outline-none text-sm mb-2"
            >
                Featured
            </label>
            <select
                name="featured"
                id="featured"
                class="text-sm border rounded"
            >
                <option
                    value="1"
                    {{ old('featured') == '1' ? 'selected' : '' }}
                >
                    Yes
                </option>
                <option
                    value="0"
                    {{ old('featured') == '0' ? 'selected' : '' }}
                >
                    No
                </option>
            </select>
        </div>

        <div class="mb-2">
            <label for="original" class="inline-block text-sm mb-2">
                Original
            </label>
            <select
                name="original"
                id="original"
                class="text-sm border rounded focus:outline-none"
                default="0"
            >
                <option
                    value="1"
                    {{ old('original') == '1' ? 'selected' : '' }}
                >
                    Yes
                </option>
                <option
                    value="0"
                    {{ old('original') == '0' ? 'selected' : '' }}
                >
                    No
                </option>
            </select>
        </div>

        <div class="mb-2">
            <label for="original_price" class="inline-block text-sm mb-2">
                Original Price
            </label>
            <input
                class="text-sm border focus:outline-none rounded p-2 w-full"
                name="original_price"
                id="original_price"
                {{ old('original_price') }}
            />

            @error('original_price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <label for="original_substrate" class="inline-block text-sm mb-2">
                Original Substrate
            </label>
            <input
                class="text-sm border focus:outline-none rounded p-2 w-full"
                name="original_substrate"
                id="original_substrate"
                {{ old('original_substrate') }}
            />

            @error('original_substrate')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <label for="original_dimensions" class="inline-block text-sm mb-2">
                Original Dimensions
            </label>
            <input
                class="text-sm border focus:outline-none rounded p-2 w-full"
                name="original_dimensions"
                id="original_dimensions"
                {{ old('original_dimensions') }}
            />

            @error('original_dimensions')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2">
            <button
                type="submit"
                class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-700"
            >
                Submit
            </button>
        </div>
    </form>
    {{-- </x-card> --}}
</x-layout>
