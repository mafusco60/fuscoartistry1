<x-layout>
    {{-- <x-card class="p-10 max-w-lg mx-auto mt-24"> --}}
    <header class="text-center">
        <h2 class="text-2xl font-bold mb-1">Add an Artwork</h2>
        <p class="mb-4"></p>
    </header>

    <form method="POST" action="/artworks" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <x-inputs.file id="image" name="image" label="Image" />
        </div>

        <div class="mb-2">
            <x-inputs.select
                id="medium"
                name="medium"
                label="Medium"
                value="{{old('medium')}}"
                :options="[ 'Graphite' => 'Graphite', 'Color Pencil' => 'Color Pencil', 'Charcoal' => 'Charcoal', 'Alcohol Marker' => 'Alcohol Marker', 'Ink' => 'Ink', 'Oil Painting' => 'Oil Painting', 'Oil Pastel' => 'Oil Pastel', 'Soft Pastel' => 'Soft Pastel', 'Acrylic Painting' => 'Acrylic Painting', 'Watercolor' => 'Watercolor', 'Mixed Media' => 'Mixed Media', 'Digital Art' => 'Digital Art', 'Other' => 'Other']"
            />
        </div>

        <div class="mb-2">
            <x-inputs.text
                id="title"
                name="title"
                label="Artwork Title"
                placeholder="Example: The Dancer"
            />
        </div>

        <div class="mb-2">
            <x-inputs.text
                id="search_tags"
                name="search_tags"
                label="Search Tags"
                placeholder="Example: Colorful, Abstract, Surreal"
            />
        </div>

        <div class="mb-2">
            <x-inputs.text-area
                id="description"
                name="description"
                label="Description"
                placeholder="Example: This piece was inspired by..."
            />
        </div>

        <div class="mb-2">
            <x-inputs.select
                id="featured"
                name="featured"
                label="Featured"
                value="{{old('featured')}}"
                :options="[ 'true' => 'Yes', 'false' => 'No']"
            />
        </div>

        <div class="mb-2">
            <x-inputs.select
                id="original"
                name="original"
                label="Original"
                value="{{old('original')}}"
                :options="[ 'true' => 'Yes', 'false' => 'No']"
            />
        </div>

        <div class="mb-2">
            <x-inputs.text
                id="original_price"
                name="original_price"
                label="Original Price"
                placeholder="Example: 200"
                type="number"
            />
        </div>

        <div class="mb-2">
            <x-inputs.text
                id="original_substrate"
                name="original_substrate"
                label="Original Substrate"
                placeholder="Example\: Artist Paper"
            />
        </div>

        <div class="mb-2">
            <x-inputs.text
                id="original_dimensions"
                name="original_dimensions"
                label="Original Dimensions"
                placeholder='Example: 12"x14"'
            />
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
